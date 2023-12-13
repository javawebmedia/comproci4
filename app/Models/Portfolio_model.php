<?php namespace App\Models;

use CodeIgniter\Model;

class Portfolio_model extends Model
{

	protected $table = 'portfolio';
    protected $primaryKey = 'id_portfolio';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('portfolio');
        $builder->select('portfolio.*, kategori_portfolio.nama_kategori_portfolio, kategori_portfolio.slug_kategori_portfolio, users.nama');
        $builder->join('kategori_portfolio','kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio','LEFT');
        $builder->join('users','users.id_user = portfolio.id_user','LEFT');
        $builder->orderBy('portfolio.id_portfolio','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // jenis
    public function jenis_portfolio_depan($jenis_portfolio)
    {
        $builder = $this->db->table('portfolio');
        $builder->select('portfolio.*, kategori_portfolio.nama_kategori_portfolio, kategori_portfolio.slug_kategori_portfolio, users.nama');
        $builder->join('kategori_portfolio','kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio','LEFT');
        $builder->join('users','users.id_user = portfolio.id_user','LEFT');
        $builder->where('portfolio.jenis_portfolio',$jenis_portfolio);
        $builder->orderBy('portfolio.id_portfolio','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // Listing
    public function paginasi_admin($limit,$start)
    {
        $this->table('portfolio');
        $this->select('portfolio.*, kategori_portfolio.nama_kategori_portfolio, kategori_portfolio.slug_kategori_portfolio, users.nama');
        $this->join('kategori_portfolio','kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio','LEFT');
        $this->join('users','users.id_user = portfolio.id_user','LEFT');
        $this->limit($limit,$start);
        $this->orderBy('portfolio.id_portfolio','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function paginasi_admin_cari($keywords,$limit,$start)
    {
        $this->table('portfolio');
        $this->select('portfolio.*, kategori_portfolio.nama_kategori_portfolio, kategori_portfolio.slug_kategori_portfolio, users.nama');
        $this->join('kategori_portfolio','kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio','LEFT');
        $this->join('users','users.id_user = portfolio.id_user','LEFT');
        $this->like('portfolio.judul_portfolio',$keywords,'BOTH');
        $this->orLike('portfolio.website',$keywords,'BOTH');
        $this->orLike('portfolio.isi',$keywords,'BOTH');
        $this->limit($limit,$start);
        $this->orderBy('portfolio.id_portfolio','DESC');
        $query = $this->get();
        return $query->getResult();
    }

    // Listing
    public function total_cari($keywords)
    {
        $this->table('portfolio');
        $this->select('portfolio.*, kategori_portfolio.nama_kategori_portfolio, kategori_portfolio.slug_kategori_portfolio, users.nama AS nama_user');
        $this->join('kategori_portfolio','kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio','LEFT');
        $this->join('users','users.id_user = portfolio.id_user','LEFT');
        $this->like('portfolio.judul_portfolio',$keywords,'BOTH');
        $this->orLike('portfolio.website',$keywords,'BOTH');
        $this->orLike('portfolio.isi',$keywords,'BOTH');
        $this->orderBy('portfolio.id_portfolio','DESC');
        $query = $this->get();
        return $query->getNumRows();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('portfolio');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_portfolio)
    {
        $builder = $this->db->table('portfolio');
        $builder->select('portfolio.*, kategori_portfolio.nama_kategori_portfolio, kategori_portfolio.slug_kategori_portfolio, users.nama');
        $builder->join('kategori_portfolio','kategori_portfolio.id_kategori_portfolio = portfolio.id_kategori_portfolio','LEFT');
        $builder->join('users','users.id_user = portfolio.id_user','LEFT');
        $builder->where('portfolio.id_portfolio',$id_portfolio);
        $builder->orderBy('portfolio.id_portfolio','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('portfolio');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('portfolio');
        $builder->where('id_portfolio',$data['id_portfolio']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('portfolio');
        $builder->where('jenis_portfolio','Homepage');
        $builder->orderBy('portfolio.id_portfolio','DESC');
        $builder->limit(5);
        $query = $builder->get();
        return $query->getRow();
    }

    // portfolio
    public function jenis_portfolio($jenis_portfolio)
    {
        $builder = $this->db->table('portfolio');
        $builder->where('jenis_portfolio',$jenis_portfolio);
        $builder->limit(5);
        $builder->orderBy('portfolio.id_portfolio','DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    // portfolio
    public function jenis_portfolio_1($jenis_portfolio)
    {
        $builder = $this->db->table('portfolio');
        $builder->where('jenis_portfolio',$jenis_portfolio);
        $builder->orderBy('portfolio.id_portfolio','DESC');
        $query = $builder->get();
        return $query->getRow();
    }

    // portfolio
    public function portfolio()
    {
        $builder = $this->db->table('portfolio');
        $builder->where('jenis_portfolio','Portfolio');
        $builder->orderBy('portfolio.id_portfolio','DESC');
        $query = $builder->get();
        return $query->getResult();
    }
}