<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EntryBranchResource\Pages;
use App\Filament\Admin\Resources\EntryBranchResource\RelationManagers;
use App\Models\EntryBranch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntryBranchResource extends Resource
{
    protected static ?string $navigationLabel = 'Entry Branch';

    protected static ?string $navigationGroup = 'Entry';

    protected static ?string $model = EntryBranch::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('entry_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('demo_version_id')
                    ->maxLength(36),
                Forms\Components\Toggle::make('is_pb')
                    ->required(),
                Forms\Components\Toggle::make('is_free')
                    ->required(),
                Forms\Components\TextInput::make('log'),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('entry_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('demo_version_id')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_pb')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_free')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListEntryBranches::route('/'),
            'create' => Pages\CreateEntryBranch::route('/create'),
            'edit' => Pages\EditEntryBranch::route('/{record}/edit'),
        ];
    }
}
