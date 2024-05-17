<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EdgeResource\Pages;
use App\Filament\Admin\Resources\EdgeResource\RelationManagers;
use App\Models\Edge;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EdgeResource extends Resource
{
    protected static ?string $navigationLabel = 'Edge';

    protected static ?string $navigationGroup = 'Category';

    protected static ?string $model = Edge::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('start_node')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('end_node')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_node')
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_node')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEdges::route('/'),
            'create' => Pages\CreateEdge::route('/create'),
            'edit' => Pages\EditEdge::route('/{record}/edit'),
        ];
    }
}
