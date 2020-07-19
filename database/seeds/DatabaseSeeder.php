<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Account\Database\Seeders\AccountDatabaseSeeder;
use Modules\Account\Database\Seeders\AccountLoginHistoryNodeTableSeeder;
use Modules\Account\Database\Seeders\AccountNodeSeeder;
use Modules\Advertisement\Database\Seeders\AdvertisementNodeSeeder;
use Modules\Advertisement\Database\Seeders\AdvertisementTypeTableSeeder;
use Modules\Anime\Database\Seeders\AnimeNodeSeeder;
use Modules\Announcement\Database\Seeders\AnnouncementNodeSeeder;
use Modules\Branch\Database\Seeders\BranchNodeSeeder;
use Modules\Classified\Database\Seeders\AVActressSettingNodeSeeder;
use Modules\Classified\Database\Seeders\CupSettingNodeSeeder;
use Modules\Classified\Database\Seeders\GenresSettingNodeSeeder;
use Modules\Classified\Database\Seeders\LanguageSettingNodeSeeder;
use Modules\Classified\Database\Seeders\RegionSettingNodeSeeder;
use Modules\Classified\Database\Seeders\SourceSettingNodeSeeder;
use Modules\Classified\Database\Seeders\YearsSettingNodeSeeder;
use Modules\Collector\Database\Seeders\CollectorDatabaseSeeder;
use Modules\Comic\Database\Seeders\ComicEpisodeNodeSeeder;
use Modules\Comic\Database\Seeders\ComicNodeSeeder;
use Modules\Drama\Database\Seeders\DramaNodeSeeder;
use Modules\Drama\Database\Seeders\DramaUpdateSeeder;
use Modules\FAQ\Database\Seeders\FAQNodeSeeder;
use Modules\Layout\Database\Seeders\LayoutNodeSeeder;
use Modules\Literature\Database\Seeders\LiteratureNodeSeeder;
use Modules\Literature\Database\Seeders\LiteratureVolumeNodeSeeder;
use Modules\Member\Database\Seeders\MemberLoginHistoryNodeSeeder;
use Modules\Member\Database\Seeders\MemberNodeSeeder;
use Modules\Movie\Database\Seeders\MovieEpisodeNodeSeeder;
use Modules\Movie\Database\Seeders\MovieNodeSeeder;
use Modules\Passport\Database\Seeders\PassportDatabaseSeeder;
use Modules\Photograph\Database\Seeders\PhotographPhotoNodeSeeder;
use Modules\Photograph\Database\Seeders\PhotographyManageNodeSeeder;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\Role\Database\Seeders\RoleNodeSeeder;
use Modules\Selfie\Database\Seeders\SelfieScheduleNodeSeeder;
use Modules\Selfie\Database\Seeders\SelfieVideoNodeSeeder;
use Modules\ShortFilm\Database\Seeders\ShortFilmNodeSeeder;
use Modules\Storytelling\Database\Seeders\StorytellingAudioNodeSeeder;
use Modules\Storytelling\Database\Seeders\StorytellingNodeSeeder;
use Modules\Topic\Database\Seeders\TopicTypeNodeSeeder;
use Modules\Video\Database\Seeders\AdultVideoBucketNodeSeeder;
use Modules\Video\Database\Seeders\AdultVideoNodeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::reguard();
        // first : no relation seeder.
        $this->call(RoleDatabaseSeeder::class);
        // second : system core define seeder.
        $this->call(AccountDatabaseSeeder::class);
        $this->call(RoleNodeSeeder::class);
        $this->call(AccountNodeSeeder::class);
        $this->call(PassportDatabaseSeeder::class);
        $this->call(AccountLoginHistoryNodeTableSeeder::class);
        //functions seeder
        $this->call(BranchNodeSeeder::class);
        $this->call(AnnouncementNodeSeeder::class);
        $this->call(AdvertisementTypeTableSeeder::class);
        $this->call(AdvertisementNodeSeeder::class);
        $this->call(FAQNodeSeeder::class);
        $this->call(LayoutNodeSeeder::class);
        $this->call(YearsSettingNodeSeeder::class);
        $this->call(LanguageSettingNodeSeeder::class);
        $this->call(SourceSettingNodeSeeder::class);
        $this->call(RegionSettingNodeSeeder::class);
        $this->call(CupSettingNodeSeeder::class);
        $this->call(AVActressSettingNodeSeeder::class);
        $this->call(GenresSettingNodeSeeder::class);
        $this->call(DramaNodeSeeder::class);
        $this->call(MemberNodeSeeder::class);
        $this->call(MemberLoginHistoryNodeSeeder::class);
        $this->call(TopicTypeNodeSeeder::class);
        $this->call(AnimeNodeSeeder::class);
        $this->call(SelfieScheduleNodeSeeder::class);
        $this->call(SelfieVideoNodeSeeder::class);
        $this->call(MovieNodeSeeder::class);
        $this->call(MovieEpisodeNodeSeeder::class);
        $this->call(AdultVideoBucketNodeSeeder::class);
        $this->call(AdultVideoNodeSeeder::class);
        $this->call(PhotographyManageNodeSeeder::class);
        $this->call(PhotographPhotoNodeSeeder::class);
        $this->call(ShortFilmNodeSeeder::class);
        $this->call(LiteratureNodeSeeder::class);
        $this->call(LiteratureVolumeNodeSeeder::class);
        $this->call(ComicNodeSeeder::class);
        $this->call(ComicEpisodeNodeSeeder::class);
        $this->call(StorytellingNodeSeeder::class);
        $this->call(StorytellingAudioNodeSeeder::class);
        $this->call(DramaUpdateSeeder::class);
        $this->call(CollectorDatabaseSeeder::class);
    }
}
