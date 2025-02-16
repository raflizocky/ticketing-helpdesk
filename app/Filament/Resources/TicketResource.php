<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Ticket Details')
                    ->schema([
                        TextInput::make('subject')
                            ->label('Ticket Subject')
                            ->placeholder('Enter ticket subject')
                            ->required(),

                        RichEditor::make('description')
                            ->label('Description')
                            ->placeholder('Enter detailed description')
                            ->required(),

                        Select::make('priority')
                            ->label('Priority')
                            ->options([
                                'Urgent' => 'Urgent',
                                'Middle' => 'Middle',
                                'Not urgent' => 'Not urgent',
                            ])
                            ->required(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'Open' => 'Open',
                                'In Progress' => 'In Progress',
                                'Resolved' => 'Resolved',
                                'Closed' => 'Closed',
                            ])
                            ->required(),

                        Select::make('department_id')
                            ->label('Department')
                            ->relationship('department', 'name')
                            ->required(),

                        Select::make('created_by')
                            ->label('Created By')
                            ->relationship('creator', 'name')
                            ->required(),

                        Select::make('assigned_to')
                            ->label('Assigned To')
                            ->relationship('assignee', 'name')
                            ->nullable(),

                        DateTimePicker::make('due_date')
                            ->label('Due Date')
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('subject')->searchable(),
                TextColumn::make('priority')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Urgent' => 'danger',
                        'Middle' => 'warning',
                        'Not urgent' => 'success',
                    })
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Open' => 'primary',
                        'In Progress' => 'warning',
                        'Resolved' => 'success',
                        'Closed' => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('department.name')
                    ->label('Department')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('creator.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('assignee.name')
                    ->label('Assigned To')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Not assigned'),
                TextColumn::make('due_date')
                    ->label('Due Date')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
