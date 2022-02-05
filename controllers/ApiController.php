<?php

namespace app\controllers;

use app\models\Category;
use app\models\CategorySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class ApiController extends Controller
{

    private $method;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST') {
            $this->createCategory();
        }
        if ($this->method == 'PUT') {
            $this->updateCategory();
        }
        if ($this->method == 'GET') {
            $this->getCategoryHierarchy();
        }
    }

    private function createCategory() {
        $rawData = json_decode(file_get_contents("php://input"));
        if ($rawData->name_hy) {
            $category = new Category();
            $category->name_hy = $rawData->name_hy;
            $category->name_en = $rawData->name_en ?? "";
            $category->name_ru = $rawData->name_ru ?? "";
            $category->status = $rawData->status > 0 ? 1 : 0;
            $category->save(false);
            if ($category->id) {
                exit("$category->id");
            } else {
                exit('Something went wrong!');
            }
        } else {
            exit('Something went wrong');
        }
    }

    private function updateCategory() {
        $rawData = json_decode(file_get_contents("php://input"));
        if ($rawData->id) {
            $category =  Category::find()->where(['id' => $rawData->id])->one();
            if ($rawData->name_hy) {
                $category->name_hy = $rawData->name_hy;
            }
            if ($rawData->name_en) {
                $category->name_en = $rawData->name_en;
            }
            if ($rawData->name_ru) {
                $category->name_ru = $rawData->name_ru;
            }
            if ($rawData->status >= 0) {
                $category->status = $rawData->status > 0 ? 1 : 0;
            }
            $category->save(false);
            if ($category->id) {
                exit("$category->id");
            } else {
                exit('Something went wrong!');
            }
        } else {
            exit('Something went wrong');
        }
    }

    /**
     * @param $categories
     * @param int $i
     * @return mixed
     */
    private function getHierarchy ($categories , $i = 0) {
        if ($categories) {
            foreach ($categories as $keys => $category) {
                $data[$keys][$i] = $category;
                $checkS = Category::find()->where(['parent_id' => $category->id])->all();
                if ($checkS) {
                    $i++;
                    $data[$keys] = $this->getHierarchy($checkS , $i);
                }
            }
        }
        return $data;
    }

    private function getCategoryHierarchy() {
        $rawData = $_GET['id'] ?? '';
        if ($rawData) {
            $data = [];
            $category_hierarchy = Category::find()->where(['parent_id' => $rawData])->all();
            foreach ($category_hierarchy as $key => $category) {
                $data[$key][0] = $category;
                $check = Category::find()->where(['parent_id' => $category->id])->all();
                $data[$key][1] = $check;
                if ($check) {
                    $data[$key]['children'] = $this->getHierarchy($check);
                }
            }
            exit(json_encode( ArrayHelper::toArray($data)));
        } else {
            exit('Something went wrong');
        }
    }

}
