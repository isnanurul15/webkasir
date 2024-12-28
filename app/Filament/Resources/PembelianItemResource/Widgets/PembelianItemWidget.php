<?php

namespace App\Filament\Resources\PembelianItemResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\PembelianItem;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\Summarizers\Summarizer;

class PembelianItemWidget extends BaseWidget
{

    public $pembelianId;

    public function mount($pembelian_id)
    {
        $this->pembelianId = $pembelian_id;
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\PembelianItem::query(), 
            )
            ->columns([
                 Tables\Columns\TextColumn::make('barang.nama')->label('Nama Barang'),
                 Tables\Columns\TextColumn::make('jumlah')->label('Jumlah Barang')->alignCenter(),
                 Tables\Columns\TextColumn::make('harga')->label('Harga Barang')->money('IDR')->alignEnd(),
                 Tables\Columns\TextColumn::make('total')->label('Harga Harga')
                 ->getStateUsing(function ($record){
                    return $record->jumlah * $record->harga;
                 } )->money('IDR')->alignEnd()
                 ->summarize(
                    Summarizer::make()
                        ->using(function ($query) {
                             return $query->sum(DB::raw('jumlah * harga'));
                            })->money('IDR'),
             ),
            ])->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        TextInput::make('jumlah')->required()
                ]),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
