<div class="page-banner position-relative" style="
    background: url('{{ $bg ?? asset('assets/images/bg/01.jpg') }}') center center / cover no-repeat, #31406b;
    min-height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin-bottom: 2rem;
">
    <div class="overlay position-absolute w-100 h-100" style="
        top:0;left:0;background:rgba(49,64,107,0.7);z-index:1;border-radius:0 0 12px 12px;
    "></div>
    <div class="container position-relative z-2 py-4" style="z-index:2;">
        @if (!empty($breadcrumbs))
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-2">
                <ol class="breadcrumb bg-transparent mb-1 p-0" style="justify-content: center;">
                    @foreach ($breadcrumbs as $url => $label)
                        @if($loop->last)
                            <li class="breadcrumb-item active text-white fw-semibold" aria-current="page">{{ $label }}</li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ $url }}" class="text-white-50 text-decoration-underline">{{ $label }}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif
        <h1 class="text-white fw-bold text-center" style="letter-spacing:2px; font-size:2.1rem; margin-bottom:0;">
            {{ $title ?? 'EverSabz' }}
        </h1>
    </div>
</div>
