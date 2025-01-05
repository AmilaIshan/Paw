<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_name'),
                TextInput::make('price')->integer(),
                TextInput::make('weight')->integer(),
                TextInput::make('quantity')->integer(),
                MarkdownEditor::make('description'),
                
                Hidden::make('admin_id')
                ->default(Auth::id()),


                FileUpload::make('image_url')
                    ->multiple()
                    ->panelLayout('grid')
                    ->reorderable()
                    ->maxFiles(4)
                    ->downloadable()
                    ->openable(),
                    // ->directory('products')
                    // ->visibility('public'), 


                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'category_name')
                    ->required()
                    ->options(
                    DB::table('categories')->pluck('category_name', 'id')->toArray()
                )
                ->placeholder("Select a category"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url'),
                TextColumn::make('product_name'),
                TextColumn::make('price'),
                TextColumn::make('quantity'),
                TextColumn::make('category.category_name')->label('Category'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
