<?php

namespace App\Containers\UserSection\User\Actions;

use App\Containers\UserSection\Student\Models\Student;
use App\Containers\UserSection\Teacher\Models\Teacher;
use App\Containers\UserSection\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DownloadUsersAction extends Action
{
    public function run()
    {
//TODO почему то не отрабатывает на проде БЕЗ
        ini_set('memory_limit', '32M');

        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type' => 'text/csv; charset=UTF-8',
            'Content-Encoding' => 'UTF-8',
            'Content-Disposition' => 'attachment; filename=user_list.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $callback = function () {
            $FH = fopen('php://output', 'wb');
            fprintf($FH, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($FH, [
                'fio',
                'type',
                'city',
                'school',
                'subject',
                'phone',
                'email',
                'utm',
                'vct'
            ], ';');

            User::query()
                ->select(['id', 'f_name', 'l_name', 'm_name', 'phone', 'email'])
                ->with([
                    'transitions' => function (HasMany $query)
                    {
                        return $query->withAggregate('quiz','vct');
                    },
                    'teacherData' => function (HasOne $query) {
                        return $query
                            ->select([
                                'id', 'school_id', 'user_id', 'subject'
                            ])->with([
                                'school' => function (BelongsTo $query) {
                                    return $query
                                        ->select([
                                            'id', 'name'
                                        ])
                                        ->withAggregate('locality', 'name');
                                }
                            ]);
                    },
                    'studentData' => function (HasOne $query) {
                        return $query
                            ->select([
                                'id', 'school_id', 'user_id',
                            ])->with([
                                'school' => function (BelongsTo $query) {
                                    return $query
                                        ->select([
                                            'id', 'name'
                                        ])
                                        ->withAggregate('locality', 'name');
                                }
                            ]);
                    },
                    'firstUtm:id,user_id,utm_source',
                ])
                ->chunk(2500, function (Collection $users) use (&$FH) {
                    foreach ($users as $user) {
                        /**
                         * @var User $user
                         * @var Student|Teacher $role
                         */

                        $vct = $user->getTransitions()?->first()?->quiz_vct;
                        if ($vct !== null)
                        {
                            $vct = 'vct'.$vct;
                        }
                        $role = $user->getUserDataRole();
                        fputcsv($FH, [
                            'fio' => $user->getFullName(),
                            'type' => $role?->getRoleNameForHuman(),
                            'city' => $role?->getSchool()?->getLocalityName(),
                            'school' => $role?->getSchoolName(),
                            'subject' => $role instanceof Teacher ? $role->getSubject() : null,
                            'phone' => $user->getPhone(),
                            'email' => $user->getEmail(),
                            'utm' => $user->getFirstUtm()?->utm_source,
                            'qr' => $vct
                        ], ';');

                    }

                });

            fclose($FH);
        };
        return response()->stream($callback, 200, $headers);
    }
}
