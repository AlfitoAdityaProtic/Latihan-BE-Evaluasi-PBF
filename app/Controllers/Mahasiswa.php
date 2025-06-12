<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Mahasiswa extends ResourceController
{
    protected $modelName = 'App\Models\MahasiswaModel';
    protected $format    = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model
            ->select('mahasiswas.*, dosens.nama as dosen_wali')
            ->join('dosens', 'dosens.nidn = mahasiswas.dosen_wali_id')
            ->findAll();

        return $this->respond([
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $mahasiswa = $this->model->find($id);
        if (!$mahasiswa) {
            return $this->failNotFound('Data Mahasiswa tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'data' => $mahasiswa
        ], 200);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = [
            'nama'  => 'required',
            'nim'  => 'required',
            'email' => 'required|valid_email',
            'angkatan' => 'required|max_length[9]',
            'prodi' => 'required',
            'dosen_wali_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);
        $this->model->insert($data);

        return $this->respondCreated([
            'message' => 'Data Mahasiswa berhasil ditambahkan',
            'data' => $data
        ]);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $mahasiswa = $this->model->find($id);
        if (!$mahasiswa) {
            return $this->failNotFound('Data Mahasiswa tidak ditemukan');
        }

        $rules = [
            'nama'  => 'required',
            'nim'  => 'required',
            'email' => 'required|valid_email',
            'angkatan' => 'required|max_length[9]',
            'prodi' => 'required',
            'dosen_wali_id' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);
        $this->model->update($id,$data);

        return $this->respond([
            'message' => 'Data Mahasiswa berhasil diupdate',
            'data' => $data
        ]);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $mahasiswa = $this->model->find($id);
        if (!$mahasiswa) {
            return $this->failNotFound('Data Mahasiswa tidak ditemukan');
        }

        $this->model->delete($id);
        return $this->respondDeleted([
            'message' => 'Data Mahasiswa berhasil dihapus'
        ]);
    }
}
