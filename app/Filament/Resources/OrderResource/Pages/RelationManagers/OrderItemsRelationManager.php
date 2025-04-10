<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->minValue(1),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('size')
                    ->label('Size'),
                Tables\Columns\TextColumn::make('color')
                    ->label('Color'),
                Tables\Columns\TextColumn::make('subtotal')
                    ->money('IDR')
                    ->getStateUsing(function ($record) {
                        return $record->price * $record->quantity;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(), // Remove this to prevent creating new items
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}