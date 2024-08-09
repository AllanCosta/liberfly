<?php

declare(strict_types=1);

namespace App\Presenters\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon; // Certifique-se de que Carbon está importado

use Illuminate\Support\Facades\Log;

trait PresentTrait
{
    /** @var Request */
    protected $request;

    /**
     * Define o Request para o trait.
     *
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * Obtém o Request.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Transformer.
     *
     * @return mixed
     */
    public function getTransformer(): mixed
    {
        $className = $this->getTransformerClassName();
        return new $className();
    }

    /**
     * Obtém o nome da classe do transformer com base no nome da classe herdada.
     *
     * @return string
     */
    protected function getTransformerClassName(): string
    {
        $inheritingClassName = get_called_class();
        $device = ucfirst($this->request->header('Device') ?? '');

        $transformerClassName = $this->buildTransformerClassName($inheritingClassName, $device);

        if (class_exists($transformerClassName)) {
            return $transformerClassName;
        }

        return 'App\\Transformers\\' . $this->transformerClassName($inheritingClassName);
    }

    /**
     * Constrói o nome da classe do transformer com base no nome da classe herdada e o dispositivo.
     *
     * @param string $inheritingClassName
     * @param string $device
     * @return string
     */
    protected function buildTransformerClassName(string $inheritingClassName, string $device): string
    {
        return 'App\\Transformers\\' . ucfirst($device) . $this->transformerClassName($inheritingClassName);
    }

    /**
     * Gera o nome da classe do transformer com base no nome da classe herdada.
     *
     * @param string $inheritingClassName
     * @return string
     */
    protected function transformerClassName(string $inheritingClassName): string
    {
        $className = substr($inheritingClassName, strrpos($inheritingClassName, '\\') + 1);
        return str_replace('Presenter', 'Transformer', $className);
    }

    /**
     * Formata uma data para um formato específico.
     *
     * @param string|null $date
     * @return string
     */
    public function formatDate(?string $date): string
    {
        return $date ? Carbon::parse($date)->format('d/m/Y') : '';
    }

    /**
     * Aplica uma máscara a um CPF/CNPJ.
     *
     * @param string $document
     * @return string
     */
    public function maskDocument(string $document): string
    {
        // Exemplo simples de máscara para CPF (11 dígitos) ou CNPJ (14 dígitos)
        return strlen($document) === 11
            ? preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $document)
            : preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $document);
    }

    /**
     * Transforma um valor booleano em um texto legível.
     *
     * @param bool $value
     * @return string
     */
    public function booleanToText(int $value): string
    {
        return $value ? 'Sim' : 'Não';
    }
}
