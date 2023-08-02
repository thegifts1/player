@extends('layouts.base')

@section('title', 'Music')

@section('content')
    @guest
        {{ __('Log in first') }}
    @endguest

    @auth
        @php
            $getID3 = new getID3();
            $getID3->encoding = 'UTF-8';
            
            $fileName = '';
            $nowPlaying = '';
            
            $arrayWithSongsInfo = [];
            $arrayWithSong = [];
            
            $ThisFileInfo = [];
            $arrayForCheck = [];
            
            $countedFiles = 1;
            
            if (!isset($_COOKIE['idSong'])) {
                $_COOKIE['idSong'] = 0;
            }
            
            if ($handle = opendir('../storage/app/UsersMusic/' . Auth::user()->name)) {
                while (false !== ($fileName = readdir($handle))) {
                    if ($fileName != '.' && $fileName != '..') {
                        $ThisFileInfo = $getID3->analyze('../storage/app/UsersMusic/' . Auth::user()->name . '/' . $fileName);
            
                        $arrayWithSong = [
                            'filename' => $ThisFileInfo['filename'],
                            'playtime_string' => $ThisFileInfo['playtime_string'],
                        ];
            
                        array_push($arrayWithSongsInfo, $arrayWithSong);
            
                        $countedFiles++;
                    }
                }
                array_unshift($arrayWithSongsInfo, 0);
                closedir($handle);
            } else {
                return redirect()->route('music.index', 'Something went wrong');
            }
            
            for ($i = 0; $i < $countedFiles; $i++) {
                array_push($arrayForCheck, $i);
            }
            
            if (isset($_GET['id'])) {
                setcookie('idSong', $_GET['id'], 0, '/public');
                unset($_GET['id']);
                header('Location:http://openserver/public/music');
                exit();
            }
            
            $i = 1;
            while ($i < $countedFiles) {
                if ($_COOKIE['idSong'] == $arrayForCheck[$i]) {
                    $nowPlaying = $arrayWithSongsInfo[$i]['filename'];
                    break;
                }
                $i++;
            }
        @endphp

        <div class="now_play">
            {{ __('Now playing:') }}
            <?= $nowPlaying ?>
        </div>
        <audio controls autoplay id="player" class="player"
            src="../storage/app/UsersMusic/<?= Auth::user()->name . '/' . $nowPlaying ?>"></audio>
        <table class="music_table">
            <tr class="music_head">
                <td class="music_center">{{ __('Play') }}</td>
                <td>{{ __('Name') }}</td>
                <td class="music_center">{{ __('Duration') }}</td>
            </tr>
            <?php for ($i = 1; $i < $countedFiles; $i++): ?>
            <tr>
                <td class="music_center">
                    <form action="music" method="GET">
                        <input name="id" type="submit" value="<?= $i ?>">
                    </form>
                </td>
                <td id="<?= $i ?>">
                    <?= $arrayWithSongsInfo[$i]['filename'] ?>
                </td>
                <td class="music_center">
                    <?= $arrayWithSongsInfo[$i]['playtime_string'] ?>
                </td>
            </tr>
            <?php endfor; ?>
        </table>

        @section('plyr.js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.8/plyr.min.js"></script>
        @endsection

        @section('plyr.css')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.7.8/plyr.min.css">
        @endsection

        @section('js')
            <script>
                const player=new Plyr("#player");var arrayWithSongsName=[];for(let i=0;i<<?=$countedFiles?>;i++)arrayWithSongsName[i]=document.getElementById(i);var counter=<?=$_COOKIE['idSong']?>,changeSong=document.getElementById("player");changeSong.onended=function(){setTimeout(function(){document.getElementsByClassName("now_play")[0].textContent=arrayWithSongsName[counter].innerText,document.getElementsByClassName("player")[0].src="../storage/app/UsersMusic/<?= Auth::user()->name ?>/"+arrayWithSongsName[counter].innerText,counter++},1)};
            </script>
        @endsection
    @endauth
@endsection
