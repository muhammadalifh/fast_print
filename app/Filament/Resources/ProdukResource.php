<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Produk;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProdukResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Kategori;
use App\Models\Status;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Number;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nama_produk')
                            ->autofocus()
                            ->filled()
                            ->placeholder('Nama Produk')
                            ->label('Nama Produk'),
                        TextInput::make('harga')
                            ->autofocus()
                            ->filled()
                            ->placeholder('Harga')
                            ->label('Harga')
                            ->rule('numeric', 'Harga harus berupa angka')
                            ,
                        Select::make('kategori_id')
                            ->autofocus()
                            ->filled()
                            ->placeholder('Pilih Kategori')
                            ->label('Kategori')
                            ->options(\App\Models\Kategori::all()->pluck('nama_kategori', 'id'))
                            ->searchable(),
                        Select::make('status_id')
                            ->autofocus()
                            ->filled()
                            ->placeholder('Pilih Status')
                            ->label('Status')
                            ->options(\App\Models\Status::all()->pluck('nama_status', 'id'))
                            ->searchable()
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('No')
                    ->sortable()
                    ->searchable()
                    // ->format(fn ($value, $record) => $record->id)
                    ->sortable(),
                TextColumn::make('nama_produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('harga')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ,
                TextColumn::make('status.nama_status')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ,
            ])
            ->filters([
                // filter status yang bisa dijual saja
                SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(\App\Models\Status::all()->pluck('nama_status', 'id'))
                    ->searchable(),
                SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->options(\App\Models\Kategori::all()->pluck('nama_kategori', 'id'))
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
