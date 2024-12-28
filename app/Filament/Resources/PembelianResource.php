<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Pembelian;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PembelianResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PembelianResource\RelationManagers;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    // Ubah ikon navigasi sesuai kebutuhan Anda
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Tambahkan label khusus untuk sidebar
    protected static ?string $navigationLabel = 'Data Pembelian';

    /**
     * Menentukan label tunggal untuk model
     */
    public static function getModelLabel(): string
    {
        return 'Pembelian';
    }

    /**
     * Menentukan label jamak untuk model
     */
    public static function getPluralModelLabel(): string
    {
        return 'Data Pembelian';
    }

    public static function form(Form $form): Form
    {
        $pembelian = new Pembelian();
        if(request()->filled('pembelian_id')){
           $pembelian = Pembelian::find(request('pembelian_id')); 
        }

        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal Pembelian')
                    ->required()
                    ->default($pembelian->tanggal)
                    ->columnSpanFull()
                    ->disabled(),
                Forms\Components\TextInput::make('supplier_id')
                    ->label('Supplier')
                    ->required()
                    ->disabled()
                    ->default($pembelian->supplier?->email),
                Forms\Components\TextInput::make('supplier_id')
                    ->label('Email Supplier')
                    ->required()
                    ->disabled()
                    ->default($pembelian->supplier?->email),
                    Forms\Components\Select::make('barang_id')
                    ->label('Barang')
                    ->required()
                    ->options(
                        \App\Models\Barang::all()->pluck('nama','id')
                    )->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $barang = \App\Models\Barang::find($state);
                        $set('harga', $barang->harga ?? null);
                    }),
                Forms\Components\TextInput::make('harga')
                    ->label('Harga Barang'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('supplier.nama_perusahaan')
                    ->label('Nama Supplier'),
               TextColumn::make('tanggal'),
               TextColumn::make('supplier.nama')
                    ->label('Nama Penghubung'),
               TextColumn::make('tanggal')->dateTime('d F Y', 'Asia/Jakarta')->label('Tanggal Pembelian'),
            ])
            ->filters([
                // Filter tabel di sini
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
            // Relasi di sini
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}
