<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MusicController extends BaseController
{
    private $music;
    private $playlists;
    private $playlist_track;

    private $db;
    public function index()
    {
        //
    }

    public function __construct()
    {
        $this->music = new \App\Models\MusicModel();
        $this->playlists = new \App\Models\PlaylistsModel();
        $this->playlist_track = new \App\Models\PlaylistTrackModel();
        $this->db = \Config\Database::connect();
        helper('form');

    }




    public function main()
    {
        $context = 'home';
        $data = [
            'playlists' => $this->playlists->findAll(),
            'music' => $this->music->findAll(),
            'context' => $context,
        ];
        return view('main', $data);
    }


    public function upload()
    {
        $file = $this->request->getFile('song');
        $newFileName = $file->getRandomName();
        var_dump($file);

        $data = [
            'title' => $file->getName(),
            'file_path' => $newFileName
        ];
        var_dump($data);
        $rules = [
            'song' => [
                'uploaded[song]',
                'mime_in[song,audio/mpeg]',
                // Allow only MP3 files
                'max_size[song,10240]',
                // Maximum file size in kilobytes (adjust as needed)
                'ext_in[song,mp3]' // Allow only files with the .mp3 extension
            ]
        ];

        if ($this->validate($rules)) {
            if ($file->isValid() && !$file->hasMoved()) {
                if ($file->move(FCPATH . 'uploads\songs', $newFileName)) {
                    echo 'File uploaded successfully';
                    $this->music->save($data);
                } else {
                    echo $file->getErrorString() . ' ' . $file->getError();
                }
            }
        } else {
            $data['validation'] = $this->validator;
        }

        return redirect()->to('/main');
    }

    public function addToPlaylist()
    {
        $musicID = $this->request->getPost('musicID');
        $playlistID = $this->request->getPost('playlist');

        // Insert a new record into the playlist_music table
        $data = [
            'playlist_id' => $playlistID,
            'music_id' => $musicID
        ];

        // Perform the insertion
        $this->playlist_track->insert($data);

        // Optionally, you can redirect the user after the insertion
        return redirect()->to('/main');
    }







    public function create_playlist()
    {
        $data = [
            'name' => $this->request->getVar('playlist_name'),
            'music' => $this->music->findAll(),
        ];

        $this->playlists->insert($data);
        return redirect()->to('/main');
    }
    // public function edit_playlist($playlist) //unnecesarry
    // {
    //     $data = [
    //         'playlist_records' => $this->playlists->where('playlist_id', $playlist)->first(),
    //         'playlists' => $this->playlists->findAll(),
    //     ];

    //     return view('main', $data);
    // }

    public function delete_playlist($student)
    {
        $this->playlists->delete($student);
        return redirect()->to('/main');
    }



    public function viewPlaylist($playlistID)
    {
        $context = 'playlist';
        // Create a query builder instance
        $builder = $this->db->table('playlist_track');

        // Select the desired columns from the 'music' table
        $builder->select('music.*');

        // Join the 'music' table based on the music_id
        $builder->join('music', 'music.music_id = playlist_track.music_id');

        // Apply a where condition to filter by playlist_id
        $builder->where('playlist_track.playlist_id', $playlistID);

        // Run the query and get the result as an array
        $musicInPlaylist = $builder->get()->getResultArray();

        // Pass the data to your view for rendering
        $data = [
            'music' => $musicInPlaylist,
            'playlists' => $this->playlists->findAll(),
            'context' => $context,
        ];

        // Load the view to display the music in the playlist
        return view('main', $data);
    }

    public function search()
    {
        $searchTerm = $this->request->getGet('search');
        $context = $this->request->getGet('context');
        $builder = $this->db->table('music');

        if ($context === 'home') {

            // Search all songs
            $builder->like('title', $searchTerm);
        } elseif ($context === 'playlist') {

            // Search songs in the current playlist
            $playlistID = $this->request->getGet('playlistID'); // Assuming you pass playlistID as a parameter
            $builder
                ->join('playlist_track', 'playlist_track.music_id = music.music_id')
                ->where('playlist_track.playlist_id', $playlistID)
                ->like('music.title', $searchTerm);
        } else {
            // Handle other contexts as needed
            // You can add more conditions here if necessary
        }

        // Get the search results
        $results = $builder->get()->getResultArray();

        // Pass the search results to the view
        $data = [
            'music' => $results,
            'playlists' => $this->playlists->findAll(),
            'context' => $context,
        ];

        return view('main', $data);
    }




}