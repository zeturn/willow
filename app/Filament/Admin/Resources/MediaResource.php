<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MediaResource\Pages;
use App\Filament\Admin\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Panel;

class MediaResource extends Resource
{
    protected static ?string $navigationLabel = 'Media';

    protected static ?string $navigationGroup = 'Media';
    
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    
                    Stack::make([
                        Tables\Columns\ImageColumn::make('media')
                            #显示当前对象中的图片
                            ->defaultImageUrl(fn ($record) => $record->url)
                            ->width(360)
                            ->height(270),
                        Panel::make([
                            Stack::make([
                                Tables\Columns\TextColumn::make('id')
                                ->label('ID')
                                ->searchable(),
                                Tables\Columns\TextColumn::make('url')
                                    ->searchable(),
                                Tables\Columns\TextColumn::make('user_id')
                                    ->searchable(),
                            ]),
                        ])->collapsible(false),    
                    ]),
                    
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
                ]),
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
