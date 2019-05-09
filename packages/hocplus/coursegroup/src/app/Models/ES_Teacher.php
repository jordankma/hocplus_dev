<?php

namespace Hocplus\Coursegroup\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Teacher;
use Hocplus\Coursegroup\App\Models\Lesson;
use Hocplus\Coursegroup\App\Models\Classes;
use Elasticquent\ElasticquentTrait;

class ES_Teacher extends Model {

    function getIndexName()
    {
        return 'hocplus_teacher';
    }
    use SoftDeletes,ElasticquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_teachers';

    protected $primaryKey = 'teacher_id';

    // protected $fillable = ['student_limit', 'student_register', 'date_start', 'date_end', 'time', 'status', 'price', 'discount', 'discount_exp', 'number_lesson', 'name', 'avartar', 'video', 'classes_id', 'subject_id', 'teacher_id', 'will_learn', 'target', 'request_content', 'summary', 'is_hot'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = false;

    public function getClasses(){        
        return $this->belongsToMany(Classes::class, 'vne_teacher_class_subject', 'teacher_id', 'classes_id')->with('getSubject')->select('vne_classes.classes_id', 'name')->distinct();
    }
    
    public function getSubject(){
        return $this->hasMany(TeacherClassSubject::class, 'teacher_id');
    }

    //es
        protected $mappingProperties = array(
            'teacher_id' => array(
                'type' => 'integer',
            ),
            'name' => array(
                'type' => 'text',
            ),
            'gender' => array(
                'type' => 'text',
            ),
            'user_name' => array(
                'type' => 'text',
            ),
            'alias' => array(
                'type' => 'text',
            ),
            'phone' => array(
                'type' => 'text',
            ),
            'email' => array(
                'type' => 'text',
            ),
            'intro' => array(
                'type' => 'text',
            ),
            'year_graduation' => array(
                'type' => 'text',
            ),
            'address' => array(
                'type' => 'text',
            ),
            'birthday' => array(
                'type' => 'text',
            ),
            'facebook' => array(
                'type' => 'text',
            ),
            'experience' => array(
                'type' => 'text',
            ),
            'workplace' => array(
                'type' => 'text',
            ),
            'avatar_index' => array(
                'type' => 'text',
            ),
            'avatar_detail' => array(
                'type' => 'text',
            ),
            'video_intro' => array(
                'type' => 'integer',
            ),
            'achievements' => array(
                'type' => 'integer',
            ),
            'rating' => array(
                'type' => 'text',
            ),
            'degree' => array(
                'type' => 'text',
            ),
            'status' => array(
                'type' => 'integer',
            ),
            'lock' => array(
                'type' => 'integer',
            ),
            'lock_time' => array(
                'type' => 'text',
            ),
            'activated' => array(
                'type' => 'integer',
            ),
            'remember_token' => array(
                'type' => 'text',
            ),
            'try_create_course' => array(
                'type' => 'text',
            ),
            'image_cmt_before' => array(
                'type' => 'text',
            ),
            'image_cmt_after' => array(
                'type' => 'text',
            ),
            'bank_name' => array(
                'type' => 'text',
            ),
            'bank_branch' => array(
                'type' => 'text',
            ),
            'bank_name_account' => array(
                'type' => 'text',
            ),
            'bank_number' => array(
                'type' => 'text',
            ),
            'said_like' => array(
                'type' => 'text',
            ),
            'timezone' => array(
                'type' => 'text',
            ),
            'update_info' => array(
                'type' => 'integer',
            ),
            'created_at' => array(
                'type' => 'date',
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
            $query['index'] = "hocplus_teacher";
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
            $query['index'] = "hocplus_teacher";
            if(!empty($params)) {
                $query['body']['query']['bool']['must'] = [];
                foreach ($params as $key => $value) {
                    if($key != 'name') {
                        $query['body']['query']['bool']['must'][] = [
                            'match' => [
                                $key => $value
                            ]
                        ];
                    }
                }
                if(!empty($param['name'])){
                    $query['body']['query']['wildcard'] = [
                        'name' => '*'. $param['name'] .'*'
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
            return self::complexSearch($query)->paginate($limit);
    //        return self::complexSearch($query);
        }
    //end es
}
