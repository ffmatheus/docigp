<script>
    window.laravel = @json($environment);
    window.mode = @if (@isset($mode)) @json($mode) @endif;
</script>

@if (!app()->environment('production') || config('app.debug'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center bg-danger text-white">
                {{ app()->environment() }}

                @if (config('app.debug'))
                    - debug mode
                @endif
            </div>
        </div>
    </div>
@endif
