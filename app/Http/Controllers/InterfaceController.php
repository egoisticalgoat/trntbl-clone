<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Illuminate\Http\Response;

class InterfaceController extends Controller
{
    /** @var  TumblrAPIController */
    private $API;

	function showListPage(string $username, string $tag = null) {
		return view('pages.list', [
			'user' => $username
		]);
	}

    function showData(string $username, string $tag = null) {
        $this->API = new TumblrAPIController(strtolower($username));

        $data = $this->loadTumblrData($tag);

        if ($data instanceof View) {
            return response(json_encode($data->getData()), 200)->header('Content-Type', 'application/json')->header('encoding', 'utf-8');
        }

        $paginatedData = new LengthAwarePaginator($data['posts'], $data['total_posts'], 20, LengthAwarePaginator::resolveCurrentPage(), [
            'path' => '/' . $username . ($tag != null ? '/' . $tag : ''),
        ]);

        $json = json_encode([
            'posts' => $paginatedData,
            'total_posts' => $data['total_posts'],
            'offset' => (LengthAwarePaginator::resolveCurrentPage() - 1) * 20,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_HEX_TAG );

        return response($json, 200)->header('Content-Type', 'application/json')->header('encoding', 'utf-8');
    }

    function showPostByID(string $username, string $id) {
        $this->API = new TumblrAPIController(strtolower($username));
        $data = $this->API->loadPostByID($id);
        $json = json_encode($data instanceof view?$data->getData():$data);
        return response($json, 200)->header('Content-Type', 'application/json')->header('encoding', 'utf-8');
    }

    function showPostByOffset(string $username, int $offset, string $tag = null) {
        $this->API = new TumblrAPIController(strtolower($username));
        $data = $this->API->loadAudioPosts(1, $offset, $tag);
        $json = json_encode($data instanceof view?$data->getData():$data);
        return response($json, 200)->header('Content-Type', 'application/json')->header('encoding', 'utf-8');
    }

    function loadTumblrData(string $tag = null) {
        $result = $this->API->isValidUser();

        if ($result === true) {
            $data = $this->API->loadAudioPosts(20, (LengthAwarePaginator::resolveCurrentPage() - 1) * 20, $tag);
            return $data;
        } else {
            if ($result instanceof View) {
                return $result;
            }

            return view('pages.main', [
                'error' => 'User not found'
            ]);
        }
    }
}