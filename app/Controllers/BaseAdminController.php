<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseAdminController
 *
 * Shared base for all admin controllers. Provides:
 * - Unified file upload / delete helpers
 * - Flash response helpers
 * - JSON response helpers
 */
abstract class BaseAdminController extends Controller
{
    protected $helpers = ['form', 'url'];

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
    }

    // -------------------------------------------------------------------------
    // File Helpers
    // -------------------------------------------------------------------------

    /**
     * Upload a single file to the given public sub-path.
     *
     * @param  string      $field     Form field name
     * @param  string      $subPath   e.g. 'uploads/skills'
     * @return string|null Filename on success, null if no valid file
     */
    protected function uploadSingleFile(string $field, string $subPath): ?string
    {
        $file = $this->request->getFile($field);

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . $subPath, $newName);
            return $newName;
        }

        return null;
    }

    /**
     * Upload multiple files from a multi-file field.
     *
     * @param  string $field    Form field name (array upload)
     * @param  string $subPath  e.g. 'uploads/documentation'
     * @return array  List of saved filenames
     */
    protected function uploadMultipleFiles(string $field, string $subPath): array
    {
        $files = $this->request->getFiles();
        $saved = [];

        if (! isset($files[$field])) {
            return $saved;
        }

        foreach ($files[$field] as $file) {
            if ($file->isValid() && ! $file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . $subPath, $newName);
                $saved[] = $newName;
            }
        }

        return $saved;
    }

    /**
     * Delete a file from a public sub-path.
     *
     * @param  string|null $filename
     * @param  string      $subPath
     */
    protected function deleteFile(?string $filename, string $subPath): void
    {
        if (! $filename) {
            return;
        }

        $path = FCPATH . rtrim($subPath, '/') . '/' . $filename;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    // -------------------------------------------------------------------------
    // Response Helpers
    // -------------------------------------------------------------------------

    /**
     * Redirect with a success flash message.
     */
    protected function redirectSuccess(string $to, string $message): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to($to)->with('success', $message);
    }

    /**
     * Redirect back with an error flash message.
     */
    protected function redirectError(string $message): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->back()->with('error', $message);
    }

    /**
     * Redirect back with validation errors and old input.
     */
    protected function redirectWithValidation(): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    /**
     * Return a JSON success response.
     */
    protected function jsonSuccess(string $message, array $extra = []): \CodeIgniter\HTTP\Response
    {
        return $this->response->setJSON(array_merge(['success' => true, 'message' => $message], $extra));
    }

    /**
     * Return a JSON error response.
     */
    protected function jsonError(string $message, int $code = 400): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode($code)->setJSON(['success' => false, 'message' => $message]);
    }
}
