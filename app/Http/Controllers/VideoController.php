<?php

namespace App\Http\Controllers;

use App\Services\VideoDownloadService;
use Exception;
use YoutubeDl\YoutubeDl;
use YoutubeDl\Options;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    protected $videoDownloadService;

    public function __construct(VideoDownloadService $videoDownloadService)
    {
        $this->videoDownloadService = $videoDownloadService;
    }

    /**
     * Exibe o formulário para download de vídeos.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('video.index');
    }

    /**
     * Controlador para baixar o vídeo.
     */



     public function download(Request $request)
     {
         // Definindo as regras de validação
         $validator = Validator::make($request->all(), [
             'url' => 'required|url|regex:/^https:\/\/(www\.)?youtube\.com\/.*$/',
         ], [
             // Mensagens personalizadas para o campo 'url'
             'url.required' => 'O campo URL é obrigatório. Por favor, insira um link.',
             'url.url' => 'O URL informado não é válido. Por favor, insira um link correto.',
             'url.regex' => 'O link fornecido deve ser do YouTube.',
         ]);

         // Se a validação falhar, retorna os erros
         if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
         }

         $url = $request->input('url');

         try {
             // Instancia o YoutubeDl
             $dl = new YoutubeDl();

             // Criando uma instância de Options corretamente
             $options = Options::create()
                 ->downloadPath(storage_path('app/public/videos')) // Define o local de armazenamento
                 ->url($url) // Define a URL do vídeo
                 ->format('bestvideo+bestaudio/best')
                 ->output('%(title)s.%(ext)s');

             // Faz o download do vídeo
             $videoCollection = $dl->download($options);
             $videos = $videoCollection->toArray();
             $firstVideo = $videos[0] ?? null;

             if ($firstVideo) {
                 // Obtendo o nome do arquivo
                 $file = $firstVideo['file']; // Objeto SplFileInfo
                 $filename = $file->getFilename(); // Obtém o nome do arquivo

                 // Retorna a resposta com o caminho do vídeo
                 return back()->with('success', 'Vídeo baixado com sucesso!')->with('video_path', asset("storage/videos/{$filename}"));
             }

             // Se não houver vídeo na coleção
             return back()->withErrors(['url' => 'Nenhum vídeo encontrado para o download.']);
         } catch (Exception $e) {
             return back()->withErrors(['url' => 'Erro ao baixar o vídeo: ' . $e->getMessage()]);
         }
     }
}
