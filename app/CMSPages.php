<?php
namespace App;

use DB;
use Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class CMSPages extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cms_pages';
    protected $primaryKey = 'pageId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'titleSlug', 'content', 'metaDescription', 'metaKeyword', 'createdAt', 'updatedAt', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Get count of cms pages with search filters
    */
    public function getPagesCount($filter) {
        $query = DB::table($this->table);

        if (isset($filter['sAction']) && $filter['sAction'] == 'filter') {
            $query->select("pageId", "title", "content", "metaDescription", "metaKeyword", "createdAt", "status");

            if (isset($filter['pageId']) && !empty($filter['pageId'])) {
                $query->where('pageId', '=', trim($filter['pageId']));
            }

            if (isset($filter['title']) && !empty($filter['title'])) {
                $query->where('title', 'LIKE', '%'.trim($filter['title']).'%');
            }

            if (isset($filter['content']) && !empty($filter['content'])) {
                $query->where('content', 'LIKE', '%'.trim($filter['content']).'%');
            }

            if (isset($filter['metaDescription']) && !empty($filter['metaDescription'])) {
                $query->where('metaDescription', 'LIKE', '%'.trim($filter['metaDescription']).'%');
            }

            if (isset($filter['metaKeyword']) && !empty($filter['metaKeyword'])) {
                $query->where('metaKeyword', 'LIKE', '%'.trim($filter['metaKeyword']).'%');
            }

            if (isset($filter['createdAt']) && !empty($filter['createdAt'])) {
                if (preg_match("/(\d{2})\/(\d{2})\/(\d{4})$/", $filter['createdAt'])) {
                    $createdAt = str_replace('/', '-', $filter['createdAt']);
                    $createdAtExp = explode("-", $createdAt);
                    $createdAt = $createdAtExp[2].'-'.$createdAtExp[1].'-'.$createdAtExp[0];
                    $query->where('createdAt', 'LIKE', '%'.trim($createdAt).'%');
                }
            }

            if (ctype_digit($filter['status'])) {
                $query->where('status', '=', trim($filter['status']));
            }
        }

        $query->whereIn('status', array('1', '0'));
        return $result = $query->count();
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Get all cms pages records with search filters
    */
    public function getAllPagesRecords($iSortCol, $sSortDir, $sGroupActionName, $iDisplayStart, $iDisplayLength, $filter, $request) {
        $table_fields = array("", "pageId", "title", "content", "metaDescription", "metaKeyword", "createdAt", "status");

        $query = DB::table($this->table);

        if (!empty($iSortCol) && !empty($sSortDir)) {
            if ($filter['sAction'] == "filter") {
                if (isset($filter['pageId']) && !empty($filter['pageId'])) {
                    $query->where('pageId', '=', trim($filter['pageId']));
                }

                if (isset($filter['title']) && !empty($filter['title'])) {
                    $query->where('title', 'LIKE', '%'.trim($filter['title']).'%');
                }

                if (isset($filter['content']) && !empty($filter['content'])) {
                    $query->where('content', 'LIKE', '%'.trim($filter['content']).'%');
                }

                if (isset($filter['metaDescription']) && !empty($filter['metaDescription'])) {
                    $query->where('metaDescription', 'LIKE', '%'.trim($filter['metaDescription']).'%');
                }

                if (isset($filter['metaKeyword']) && !empty($filter['metaKeyword'])) {
                    $query->where('metaKeyword', 'LIKE', '%'.trim($filter['metaKeyword']).'%');
                }

                if (isset($filter['createdAt']) && !empty($filter['createdAt'])) {
                    if (preg_match("/(\d{2})\/(\d{2})\/(\d{4})$/", $filter['createdAt'])) {
                        $createdAt = str_replace('/', '-', $filter['createdAt']);
                        $createdAtExp = explode("-", $createdAt);
                        $createdAt = $createdAtExp[2].'-'.$createdAtExp[1].'-'.$createdAtExp[0];
                        $query->where('createdAt', 'LIKE', '%'.trim($createdAt).'%');
                    }
                }

                if (ctype_digit($filter['status'])) {
                    $query->where('status', '=', trim($filter['status']));
                }
            }
        }

        $query->select("pageId", "title", "content", "metaDescription", "metaKeyword", "createdAt", "status");
        $query->whereIn('status', array('1', '0'));
        $query->orderBy($table_fields[$iSortCol], $sSortDir);
        $query->limit($iDisplayLength)->offset($iDisplayStart);
        return $query->get();
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Update cms page details
    */
    public function updateCMSPage($request)
    {
        if ($this::save()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Developed Name: Manan Patel
     * Modified By:
     * Modified Date:
     * Description: Get cms page details
     */
    public static function getCMSPage($pageId)
    {
        return DB::table('cms_pages')
                ->where('pageId', '=', $pageId)
                ->where('status', '=', '1')
                ->get();
    }
}
