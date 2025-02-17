@extends('layouts.app', ['class' => 'register-page', 'page' => __('Home'), 'contentClass' => 'register-page'])
<style>
    .card.card-white .form-control {
        background-color: #fff;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-md-5 ml-auto">
            <div class="info-area info-horizontal mt-5">
                <div class="description">
                    <h3 class="info-title">{{ __('Cole o URL do vídeo do YouTube') }}</h3>
                    <p class="description">
                        {{ __('Clique nas Diretrizes de Uso e, após lê-las completamente, se concordar e cumprir o conteúdo das Diretrizes, cole a URL do vídeo do YouTube no campo fornecido.') }}
                    </p>
                    <img src="{{ asset('black') }}/img/step-1.png" alt="Descrição da imagem" class="img-fluid">
                </div>
            </div>
            <div class="info-area info-horizontal">
                <div class="description">
                    <h3 class="info-title">{{ __('Baixar video') }}</h3>
                    <p class="description">
                        {{ __('Clique no botão "Download" para ir à página de download, selecione a qualidade que precisa e clique em download.') }}
                    </p>
                    <img src="{{ asset('black') }}/img/step-2.png" alt="Descrição da imagem" class="img-fluid">
                </div>
            </div>
            <div class="info-area info-horizontal">
                <div class="description">
                    <h3 class="info-title">{{ __('Baixe o arquivo') }}</h3>
                    <p class="description">
                        {{ __('Em apenas alguns segundos, você obterá os links') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-7 mr-auto">
            <div class="card card-register card-white">
                <div class="card-header p-0">
                    <img class="card-img" src="{{ asset('black') }}/img/card-primary.png" alt="Card image"
                        style="top:0;z-index: 0;opacity: 0.45;">

                </div>
                <form class="form" method="post" action="{{ route('download-video') }}" style="z-index: 1" id="downloadForm">
                    @csrf
                    <div class="card-body pt-4">
                        <h2 class="card-title text-bold text-center" style="color:#000; font-weight: bold">
                            {{ __('Baixador de vídeos do YouTube') }}</h2>

                        <h4 class="text-center pt-2 pb-3" style="color:#000;">Baixe qualquer vídeo público do YouTube,
                            transcreva-o
                            para
                            texto, extraia ou adicione legendas!</h4>

                        <div class="input-group{{ $errors->has('url') ? ' has-danger' : '' }}">
                            <input type="text" name="url"
                                class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Cole aqui o URL de um vídeo do Youtube') }}"
                                style="height: 60px; font-size: larger; color: #000; border: 1px solid rgba(29, 37, 59, 0.2); border-radius: 7px;"
                                required>

                            <!-- Exibição do erro -->
                            @if ($errors->has('url'))
                                <div class="invalid-feedback" style="color: red; font-size: 14px;">
                                    {{ $errors->first('url') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-check text-left pt-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" required>
                                <span class="form-check-sign"></span>
                                {{ __('Ao baixar este vídeo do YouTube, você concorda ') }}
                                <a href="#">{{ __('Diretrizes de Uso') }}</a>.
                            </label>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary btn-round btn-lg" id="downloadButton">
                            <i class="tim-icons icon-cloud-download-93 pr-2"></i>
                            {{ __('Download') }}</button>
                    </div>
                </form>
                @if (session('video_path'))
                    <div class="card-footer text-center">
                        <p>Download Completo</p>
                        <a href="{{ session('video_path') }}" target="_blank">
                        <button type="submit" class="btn btn-primary btn-round btn-lg" id="downloadButton">

                            {{ __('Baixar Video') }}</button>
                        </a>
                    </div>

                @endif

            </div>
        </div>
    </div>

    <script>
        document.getElementById('downloadForm').addEventListener('submit', function(event) {
            // Desabilita o botão de download
            var button = document.getElementById('downloadButton');
            button.disabled = true;
            button.innerHTML = '<i class="tim-icons icon-cloud-download-93 pr-2"></i> Processando...';
        });
    </script>
@endsection
