<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Home;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        $this->call('PostSeeder');
        $this->call('HomeSeeder');
        
    }
}
class HomeSeeder extends Seeder
{
    public function run()
    {
        DB::table('Homes')->delete();
        Home::create ([
            'title' => 'Ученые назвали улучшающее память биологическое соединение',
            'slug' => 'Часть первая ',
            'excert' => '<b>Первый пост</b>',
            'content' => '<b>Украина стоит на пороге эпидемии кори. К такой ситуации привел низкий уровень вакцинации против заболевания среди украинских детей - всего 10% маленьких украинцев привиты против опасного инфекционного заболевания.
Об этом сообщила заведующая отделом респираторных и других вирусных инфекций Института эпидемиологии и инфекционных Болезней им. Громашевского НАМН Украины Алла Мироненко в комментарии корреспонденту ГолосUA.
            </b>',
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
            'published' => true,
        ]);
        Home::create ([
            'title' => 'Ученые назвали улучшающее память биологическое соединение',
            'slug' => 'Часть 2',
            'excert' => '<b>Второй пост</b>',
            'content' => '<b>Украина стоит на пороге эпидемии кори. К такой ситуации привел низкий уровень вакцинации против заболевания среди украинских детей - всего 10% маленьких украинцев привиты против опасного инфекционного заболевания.
Об этом сообщила заведующая отделом респираторных и других вирусных инфекций Института эпидемиологии и инфекционных Болезней им. Громашевского НАМН Украины Алла Мироненко в комментарии корреспонденту ГолосUA.
            </b>',
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
            'published' => true,
        ]);

        Home::create ([
            'title' => 'Наночастицы для борьбы с раковыми клетками',
            'slug' => 'третья часть',
            'excert' => '<b>Пост 4</b>',
            'content' => '<b>Испанские ученые получили наночастицу, которая способна различать раковые клетки от здоровых и доставлять противоопухолевое средство только в первые из них. Основой наночастиц является гидрогель – специальный нанополимер, разбухающий после его поглощения раковыми клетками и не растворяющийся в жидкой среде крови</b>',
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),                
            'published' => true,
        ]);

    }

}
class PostSeeder extends Seeder
{
    public function run()
    {
        DB::table('Posts')->delete();
        Post::create ([
            'title' => 'First Post',
            'slug' => 'first-post1',
            'excert' => '<b>First post body</b>',
            'content' => '<b>Content pirst body</b>',
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
            'published' => true,
        ]);
        Post::create ([
            'title' => 'Second Post',
            'slug' => 'first-post2',
            'excert' => '<b>First post body</b>',
            'content' => '<b>Content pirst body</b>',
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
            'published' => false,
        ]);

        Post::create ([
            'title' => 'Third Post',
            'slug' => 'first-post3',
            'excert' => '<b>First post body</b>',
            'content' => '<b>Content pirst body</b>',
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),                
            'published' => false,
        ]);

    }
}
