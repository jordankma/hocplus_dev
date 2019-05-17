<?php

namespace Hocplus\Coursegroup\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Teacher;
use Hocplus\Coursegroup\App\Models\Lesson;
use Hocplus\Coursegroup\App\Models\Classes;
use Elasticquent\ElasticquentTrait;

class ES_News extends Model {

    function getIndexName()
    {
        return 'hocplus_news';
    }
    use SoftDeletes,ElasticquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_news';

    protected $primaryKey = 'news_id';

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;

    //end rela mysql

    //es
        protected $mappingProperties = array(
            'news_id' => array(
                'type' => 'integer',
            ),
            'create_by' => array(
                'type' => 'text',
            ),
            'news_cat' => array(
                'type' => 'text',
            ),
            'news_tag' => array(
                'type' => 'text',
            ),
            'news_box' => array(
                'type' => 'text',
            ),
            'news_box' => array(
                'type' => 'text',
            ),
            'title' => array(
                'type' => 'text',
            ),
            'title_alias' => array(
                'type' => 'text',
            ),
            'desc' => array(
                'type' => 'text',
            ),
            'image' => array(
                'type' => 'text',
            ),
            'is_hot' => array(
                'type' => 'text',
            ),
            'type' => array(
                'type' => 'text',
            ),
            'type_page' => array(
                'type' => 'text',
            ),
            'gallery' => array(
                'type' => 'text',
            ),
            'priority' => array(
                'type' => 'integer',
            ),
            'key_word_seo' => array(
                'type' => 'text',
            ),
            'desc_seo' => array(
                'type' => 'integer',
            ),
            'visible' => array(
                'type' => 'integer',
            ),
            'student_limit' => array(
                'type' => 'integer',
            ),
            'status' => array(
                'type' => 'integer',
            ),
            'created_at' => array(
                'type' => 'float',
            ),
            'updated_at' => array(
                'type' => 'date'
            ),
            'deleted_at' => array(
                'type' => 'date'
            ),
            'sync_es' => array(
                'type' => 'integer'
            )
        );
        protected $hidden = ['course_id', 'updated_at', 'deleted_at'];
        protected $indexSettings = [
            'analysis' => [
                'char_filter' => [
                    'replace' => [
                        'type' => 'mapping',
                        'mappings' => [
                            '&=> and '
                        ],
                    ],
                ],
                'filter' => [
                    'word_delimiter' => [
                        'type' => 'word_delimiter',
                        'split_on_numerics' => false,
                        'split_on_case_change' => true,
                        'generate_word_parts' => true,
                        'generate_number_parts' => true,
                        'catenate_all' => true,
                        'preserve_original' => true,
                        'catenate_numbers' => true,
                    ]
                ],
                'analyzer' => [
                    'default' => [
                        'type' => 'custom',
                        'char_filter' => [
                            'html_strip',
                            'replace',
                        ],
                        'tokenizer' => 'whitespace',
                        'filter' => [
                            'lowercase',
                            'word_delimiter',
                        ],
                    ],
                ],
            ],
        ];

        public function setUpdatedAt($value)
        {
            // Do nothing.
        }

        public function getUpdatedAtColumn()
        {
            //Do-nothing
        }

    //    public static function searchByQuery($query = null, $aggregations = null, $sourceFields = null, $limit = null, $offset = null, $sort = null)
    //    {
    //        $params = [];
    //        if(!empty($query)){
    //            foreach ($query as $key => $item){
    //                $params[] = [
    //                    'match' => [
    //                        $key => $item
    //                    ]
    //                ];
    //            }
    //        }
    //        return self::searchByQuery($params,null,null,$limit, $offset);
    //    }

        public static function customSearch($param,$offset = null,$limit = null){

            $query = [
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => []
                        ]
                    ]
                ]
            ];
            $query['index'] = "hocplus_news";
            if(!empty($param)) {
                foreach ($param as $key => $value) {
                    $query['body']['query']['bool']['must'][] = [
                        'match' => [
                            $key => $value
                        ]
                    ];
                }
            }
            if(!empty($limit)){
                if(!empty($offset)){
                    $query['body']['size'] = $limit;
                    $query['body']['from'] = $offset;
                }
            }


        //    echo '<pre>';print_r($query);echo '</pre>';die;
            return self::complexSearch($query);
        }

        public function paginateSearch($params, $page, $limit){
            $query = [];
            $query['index'] = "hocplus_news";
            if(!empty($params)) {
                $query['body']['query']['bool']['must'] = [];
                foreach ($params as $key => $value) {
                    if($key != 'title') {
                        $query['body']['query']['bool']['must'][] = [
                            'match' => [
                                $key => $value
                            ]
                        ];
                    }
                }
                if(!empty($param['title'])){
                    $query['body']['query']['wildcard'] = [
                        'title' => '*'. $param['title'] .'*'
                    ];
                }
            }
            else{
                $query['body']['query']['match_all'] = [
                    'boost' => 1.0
                ];
            }
            if(!empty($page) && !empty($limit)){
    //            $query['body']['search_type'] = 'scan';
    //            $query['scroll'] = '30s';
                $query['body']['from'] = ($page -1)*$limit;
                $query['body']['size'] = $limit;

            }
            return self::complexSearch($query)->paginate($limit, ['*'], 'page-course');
    //        return self::complexSearch($query);
        }
    //end es
}
