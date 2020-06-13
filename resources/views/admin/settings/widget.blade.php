@extends('admin.components.layout')

@section('title', 'Ustawienia widgetów')

@section('acp-card-title')
    <h4 class="acp-card-title">
        <i class="fas fa-ticket-alt"></i> Ustawienia widgetów
    </h4>
    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-primary">
        <i class="fas fa-chevron-left"></i>
        Wróć
    </a>
@endsection

@section('content')
    <ul class="widget-list">
        <li class="widget">
            <div class="widget-icon">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-square fa-stack-2x"></i>
                    <i class="fab fa-teamspeak fa-stack-1x fa-inverse"></i>
                </span>
            </div>
            <div class="widget-content">
                <h4 class="widget-name">Status serwera Teamspeak</h4>
                <div class="widget-actions">
                    <a href="{{ route('admin.settings.widget.teamspeak.index') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-title="Konfiguracja">
                        <i class="fas fa-cogs fa-fw"></i>
                    </a>
                </div>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input entityActiveStatusSwitch" id="widgetTeamspeakActiveSwitch" data-target="{{ route('admin.settings.widget.teamspeak.toggle_active') }}" {{ setting('settings_widget_teamspeak_active') ? 'checked' : '' }}>
                <label class="custom-control-label" for="widgetTeamspeakActiveSwitch"></label>
            </div>
        </li>
        
        <li class="widget">
            <div class="widget-icon">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-square fa-stack-2x"></i>
                    <i class="fab fa-discord fa-stack-1x fa-inverse"></i>
                </span>
            </div>
            <div class="widget-content">
                <h4 class="widget-name">Status serwera Discord</h4>
                <div class="widget-actions">
                    <a href="{{ route('admin.settings.widget.discord.index') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-title="Konfiguracja">
                        <i class="fas fa-cogs fa-fw"></i>
                    </a>
                </div>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input entityActiveStatusSwitch" id="widgetDiscordActiveSwitch" data-target="{{ route('admin.settings.widget.discord.toggle_active') }}" {{ setting('settings_widget_discord_active') ? 'checked' : '' }}>
                <label class="custom-control-label" for="widgetDiscordActiveSwitch"></label>
            </div>
        </li>
        
        <li class="widget">
            <div class="widget-icon">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-square fa-stack-2x"></i>
                    <i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
                </span>
            </div>
            <div class="widget-content">
                <h4 class="widget-name">Cel miesięczny</h4>
                <div class="widget-actions">
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="tooltip" data-title="Konfiguracja">
                        <i class="fas fa-cogs fa-fw"></i>
                    </a>
                </div>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input entityActiveStatusSwitch" id="widgetMonthlyGoalActiveSwitch" data-target="{{ route('admin.settings.widget.teamspeak.toggle_active') }}" {{ setting('settings_widget_teamspeak_active') ? 'checked' : '' }}>
                <label class="custom-control-label" for="widgetMonthlyGoalActiveSwitch"></label>
            </div>
        </li>
    </ul>
@endsection
