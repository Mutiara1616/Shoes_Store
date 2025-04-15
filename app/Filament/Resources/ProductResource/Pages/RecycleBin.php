<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class RecycleBin extends ListRecords
{
    protected static string $resource = ProductResource::class;
    
    protected static ?string $title = 'Product Recycle Bin';
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Back to Products')
                ->url(ProductResource::getUrl())
                ->icon('heroicon-o-arrow-left'),
        ];
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query()->onlyTrashed())
            ->columns([
                    
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category'),
                    
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand'),
                    
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('stock')
                    ->sortable(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                    
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Deleted At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('restore')
                    ->label('Restore')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->button() // Makes it more visible as a button
                    ->action(function (Product $record) {
                        $record->restore();
                        
                        Notification::make()
                            ->title('Product restored')
                            ->body('The product "' . $record->name . '" has been successfully restored.')
                            ->success()
                            ->send();
                            
                        return redirect(ProductResource::getUrl('recycle-bin'));
                    }),
                
                Tables\Actions\Action::make('force_delete')
                    ->label('Delete Permanently')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->button()
                    ->action(function (Product $record) {
                        $name = $record->name;
                        $record->forceDelete();
                        
                        Notification::make()
                            ->title('Product permanently deleted')
                            ->body('The product "' . $name . '" has been permanently deleted.')
                            ->warning()
                            ->send();
                            
                        return redirect(ProductResource::getUrl('recycle-bin'));
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('restore')
                        ->label('Restore Selected')
                        ->icon('heroicon-o-arrow-uturn-left')
                        ->color('success')
                        ->action(function (Collection $records) {
                            $count = $records->count();
                            $records->each->restore();
                            
                            Notification::make()
                                ->title($count . ' products restored')
                                ->body($count . ' products have been successfully restored.')
                                ->success()
                                ->send();
                                
                            return redirect(ProductResource::getUrl('recycle-bin'));
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    Tables\Actions\BulkAction::make('force_delete')
                        ->label('Delete Permanently')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->action(function (Collection $records) {
                            $count = $records->count();
                            $records->each->forceDelete();
                            
                            Notification::make()
                                ->title($count . ' products permanently deleted')
                                ->body($count . ' products have been permanently deleted from the system.')
                                ->warning()
                                ->send();
                                
                            return redirect(ProductResource::getUrl('recycle-bin'));
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->emptyStateHeading('No deleted products')
            ->emptyStateDescription('Once you delete products, they will appear here.');
    }
    
    protected function getTableQuery(): Builder
    {
        // Override this to remove any existing scope
        return Product::query()->onlyTrashed();
    }
}