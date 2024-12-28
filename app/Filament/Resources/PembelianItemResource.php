<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PembelianItem;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\PembelianItemResource\Pages;

class PembelianItemResource extends Resource
{
    protected static ?string $model = PembelianItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                     ->schema([
                        DatePicker::make('tanggal')
                            ->label('Tanggal Pembelian')
                            ->required(),
                        TextInput::make('supplier_nama')
                            ->label('Supplier')
                            ->required(),
                        TextInput::make('supplier_email')
                            ->label('Email Supplier')
                            ->required(),
                    ])->columns(3),
                Grid::make()
                ->schema([
                    Select::make('barang_id')
                        ->label('Barang')
                        ->required()
                        ->options(
                            \App\Models\Barang::query()->pluck('nama', 'id')->toArray()
                        )->reactive()
                        ->afterStateUpdated(function ($state, Set $set, Get $get) {
                            $barang = \App\Models\Barang::find($state);
                            $set('harga', $barang->harga ?? null);
                            $jumlah = $get('jumlah');
                            $total = $jumlah * $barang->harga;
                            $set('total', $total);
                        }), 
                    TextInput::make('harga')
                        ->label('Harga Barang')
                        ->required(),
                    TextInput::make('jumlah')
                        ->reactive()
                        ->afterStateUpdated(function ($state, Set $set, Get $get) {
                            $jumlah = $state;
                            $harga = $get('harga');
                            $total = $jumlah * $harga;
                            $set('total', $total);
                        }) 
                        ->label('Jumlah Barang')
                        ->required()
                        ->default(1),
                    TextInput::make('total')
                        ->label('Total Harga')
                        ->disabled()
                        ->default(fn (callable $get) => $get('harga') * $get('jumlah')),
                ])->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pembelian_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('barang.id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPembelianItems::route('/'),
            'create' => Pages\CreatePembelianItem::route('/create'),
            'edit' => Pages\EditPembelianItem::route('/{record}/edit'),
        ];
    }
}
