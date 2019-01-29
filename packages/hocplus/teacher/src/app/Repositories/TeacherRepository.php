<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Teacher\App\Repositories;

use Adtech\Application\Cms\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Class DemoRepository
 * @package Hocplus\Teacher\Repositories
 */
class TeacherRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return 'Hocplus\Teacher\App\Models\Teacher';
    }

    public function findAll() {
        $result = $this->model();
        $result::all();
        return $result;
    }

    /**
     * filter teachers by params
     */
    public function filter($params) {
        $model = $this->model;
        $keyword = isset($params['keyword'])?$params['keyword']:'';
        $sort = isset($params['sort'])?$params['sort']:'';   
        if ($sort == 'name') {
            $query = $model->where('name','LIKE','%'.$keyword.'%')->orderBy('name'); 
        }
        else if ($sort == 'newest') {
            $query = $model->where('name','LIKE','%'.$keyword.'%')->orderBy('updated_at','desc'); 
        }
        else {
            $query = $model->where('name','LIKE','%'.$keyword.'%');     
        }
        /** filter by class_id */     
        if (isset($params['byclass']) &&  isset($params['bysubject'])) {
            $query = $model->listClass($params['byclass'], $params['bysubject']);
            return $query;            
        }
        else if (isset($params['byclass'])) { 
            $query = $model->listClass($params['byclass']);
            return $query;
        }
        else if (isset($params['bysubject'])) {
            $query = $model->listClass(0,$params['bysubject']);
            return $query;
        }
        /** filter by course status */
        if (isset($params['incomming'])) {
            $query = $model->listCourse('incomming');
            return $query;
        }
        else if (isset($params['upcomming'])) {
            $query = $model->listCourse('upcomming');
            return $query;
        }
        $result = $query->paginate(10);       
        return $result;        
    }
}