<?php

namespace App\Models;

use CodeIgniter\Model;

class MusicModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'music';
    protected $primaryKey = 'music_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['title', 'artist', 'file_path', 'duration', 'album', 'genre', 'created_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getMusicByPlaylist($playlistID)
    {
        $builder = $this->db->table('playlist_track');
        $builder->select('music.*');
        $builder->join('music', 'music.music_id = playlist_track.music_id');
        $builder->where('playlist_track.playlist_id', $playlistID);

        return $builder->get()->getResultArray();

    }
    // public function getMusicByPlaylist($playlistID)
    // {
    //     // Assuming you have a 'playlist_music' table to establish the relationship between playlists and music
    //     $builder = $this->db->table('playlist_track');
    //     $builder->select('music.*');
    //     $builder->join('music', 'music.music_id = playlist_track.music_id');
    //     $builder->where('playlist_track.playlist_id', $playlistID);

    //     return $builder->get()->getResult();
    // }

}