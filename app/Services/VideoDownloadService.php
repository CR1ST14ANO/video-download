<?php

namespace App\Services;

use YoutubeDl\YoutubeDl;
use Exception;

class VideoDownloadService
{
    /**
     * Baixar o vídeo do YouTube.
     *
     * @param string $url
     * @param string $outputPath
     * @return array
     */
    public function downloadVideo($url, $outputPath)
    {
        // Cria uma instância do yt-dlp
        $ytDl = new YoutubeDl();

        // Define as opções (como escolher o melhor vídeo e áudio)
        $ytDl->setOption('format', 'bestvideo+bestaudio')
             ->setOption('output', $outputPath); // Caminho de saída do vídeo

        try {
            // Baixa o vídeo
            $video = $ytDl->download($url);

            return [
                'status' => 'success',
                'message' => 'Download realizado com sucesso!',
                'video' => $video
            ];
        } catch (Exception $e) {
            // Em caso de erro, retorna a mensagem
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
