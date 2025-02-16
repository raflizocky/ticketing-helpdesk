<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //card
                Section::make()
                    ->schema([

                        // Name
                        TextInput::make('name')
                            ->label('User Name')
                            ->placeholder('Enter full name')
                            ->required(),

                        // Email
                        TextInput::make('email')
                            ->label('Email Address')
                            ->placeholder('Enter email')
                            ->email()
                            ->unique('users', 'email')
                            ->required(),

                        // Password
                        TextInput::make('password')
                            ->label('Password')
                            ->placeholder('Enter password')
                            ->password()
                            ->required()
                            ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                            ->revealable(),

                        // Role Selection
                        Select::make('role')
                            ->label('User Role')
                            ->options([
                                'admin' => 'Admin',
                                'employee' => 'Employee',
                            ])
                            ->required(),

                        // Department Selection
                        Select::make('department_id')
                            ->label('Department')
                            ->relationship('department', 'name')
                            ->required(),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
