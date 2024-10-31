<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Label;

class StudentResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nim')
                    ->label('Nim')
                    ->required()
                    ->numeric()
                    ->maxLength(10),
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(64),
                Select::make('group_id')
                    ->label('Kelas')
                    ->placeholder('Pilih Kelas')
                    ->relationship('group', 'name') // assuming 'group' relationship exists
                    ->required(),
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'male' => 'Laki-laki',
                        'female' => 'Perempuan',
                    ])
                    ->placeholder('Pilih Jenis Kelamin')
                    ->required(),
                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nim')
                    ->searchable()
                    ->sortable()
                    ->label('Nim'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('group.name')
                    ->searchable()
                    ->sortable()
                    ->label('Kelas'),
                BadgeColumn::make('gender')
                    ->sortable()
                    ->colors([
                        'primary' => 'female',
                        'success' => 'male',
                    ])
                    ->label('Jenis Kelamin'),
                BooleanColumn::make('verified')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Mahasiswa';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Mahasiswa';
    }
}
