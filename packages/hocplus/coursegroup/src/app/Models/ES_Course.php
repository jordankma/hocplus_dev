<?php

namespace Hocplus\Coursegroup\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hocplus\Coursegroup\App\Models\Subject;
use Hocplus\Coursegroup\App\Models\Teacher;
use Hocplus\Coursegroup\App\Models\Lesson;
use Hocplus\Coursegroup\App\Models\Classes;
use Elasticquent\ElasticquentTrait;

class ES_Course extends Model {

    function getIndexName()
    {
        return 'hocplus_course';
    }
    use SoftDeletes,ElasticquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hocplus_course';

    protected $primaryKey = 'course_id';

    protected $fillable = ['student_limit', 'student_register', 'date_start', 'date_end', 'time', 'status', 'price', 'discount', 'discount_exp', 'number_lesson', 'name', 'avartar', 'video', 'classes_id', 'subject_id', 'teacher_id', 'will_learn', 'target', 'request_content', 'summary', 'is_hot'];

    protected $dates = ['deleted_at'];
    
    public $timestamps = true;
    
    //rela mysql
    public function isClass(){
        return $this->belongsTo(Classes::class, 'classes_id');
    }
    
    public function isSubject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    
    public function isTeacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    
    public function getLesson(){
        return $this->hasMany(Lesson::class, 'course_id');
    }

    //end rela mysql

    //es
        protected $mappingProperties = array(
            'course_id' => array(
                'type' => 'integer',
            ),
            'name' => array(
                'type' => 'text',
            ),
            'alias' => array(
                'type' => 'text',
            ),
            'avartar' => array(
                'type' => 'text',
            ),
            'video' => array(
                'type' => 'text',
            ),
            'will_learn' => array(
                'type' => 'text',
            ),
            'target' => array(
                'type' => 'text',
            ),
            'request_content' => array(
                'type' => 'text',
            ),
            'province_name' => array(
                'type' => 'text',
            ),
            'summary' => array(
                'type' => 'text',
            ),
            'is_hot' => array(
                'type' => 'integer',
            ),
            'classes_id' => array(
                'type' => 'integer',
            ),
            'subject_id' => array(
                'type' => 'integer',
            ),
            'teacher_id' => array(
                'type' => 'integer',
            ),
            'student_limit' => array(
                'type' => 'integer',
            ),
            'student_register' => array(
                'type' => 'integer',
            ),
            'date_start' => array(
                'type' => 'integer',
            ),
            'date_end' => array(
                'type' => 'integer',
            ),
            'time' => array(
                'type' => 'text',
            ),
            'status' => array(
                'type' => 'integer',
            ),
            'active' => array(
                'type' => 'integer',
            ),
            'price' => array(
                'type' => 'integer',
            ),
            'discount' => array(
                'type' => 'integer',
            ),
            'discount_exp' => array(
                'type' => 'integer',
            ),
            'number_lesson' => array(
                'type' => 'integer',
            ),
            'keyword' => array(
                'type' => 'text',
            ),
            'document' => array(
                'type' => 'text',
            ),
            'exam_id' => array(
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
            $query['index'] = "hocplus_course";
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
            $query['index'] = "hocplus_course";
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
