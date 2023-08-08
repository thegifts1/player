@extends('layouts.base')

@section('title', 'Music')

@section('content')
    @guest
        {{ __('Log in first') }}
    @endguest

    @auth
        @php
            $counter++;
            $nowPlaying = '';
            $arrayForCheck = [];
            
            if (!isset($_COOKIE['idSong'])) {
                $_COOKIE['idSong'] = 9999;
            }
            
            for ($i = 0; $i < $counter; $i++) {
                array_push($arrayForCheck, $i);
            }
            
            if (isset($_GET['id'])) {
                setcookie('idSong', $_GET['id'], 0, '/public');
                unset($_GET['id']);
                header("Location:http://site/public/music");
                exit();
            }
            
            $i = 1;
            while ($i < $counter) {
                if ($_COOKIE['idSong'] == $arrayForCheck[$i]) {
                    $nowPlaying = $songs[$i]['track_name'];
                    break;
                }
                $i++;
            }
        @endphp

        <div class="now_play">
            {{ __('Now playing: ') }}
            <?= $nowPlaying ?>
        </div>
        <img id="pastSong" class="arrow" src="img/svg/left-arrow.svg" alt="left">
        <img id="nextSong" class="arrow" src="img/svg/right-arrow.svg" alt="right">
        <div id="player_container">
            <audio controls autoplay id="player" class="player"
                src="../storage/app/UsersMusic/<?= Auth::user()->name . '/' . $nowPlaying ?>"></audio>
        </div>
        <table class="music_table">
            <tr class="music_head">
                <td>{{ __('Play') }}</td>
                <td>{{ __('Name') }}</td>
                <td>{{ __('Duration') }}</td>
            </tr>
            <?php for ($i = 1; $i < $counter; $i++): ?>
            <tr>
                <td>
                    <form method="GET">
                        <input name="id" type="submit" value="<?= $i ?>">
                    </form>
                </td>
                <td id="<?= $i ?>">
                    <?= $songs[$i]['track_name'] ?>
                </td>
                <td>
                    <?= $songs[$i]['duration'] ?>
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
const player=new Plyr("#player");var arrayWithSongsName=[];for(let i=0;i<<?=$counter?>;i++){arrayWithSongsName[i]=document.getElementById(i);};var counter=<?=$_COOKIE['idSong']?>;var nowPlay="Now playing: "
changeSong=document.getElementById("player");changeSong.onended=function(){counter++;document.getElementsByClassName("now_play")[0].textContent=nowPlay+arrayWithSongsName[counter].innerText;document.getElementsByClassName("player")[0].src="../storage/app/UsersMusic/<?= Auth::user()->name ?>/"+
arrayWithSongsName[counter].innerText;document.cookie="idSong="+counter;};next=function(){counter++;document.getElementsByClassName("now_play")[0].textContent=nowPlay+arrayWithSongsName[counter].innerText;document.getElementsByClassName("player")[0].src="../storage/app/UsersMusic/<?= Auth::user()->name ?>/"+
arrayWithSongsName[counter].innerText;document.cookie="idSong="+counter;};var nextSong=document.getElementById('nextSong');nextSong.addEventListener('click',next);past=function(){counter--;document.getElementsByClassName("now_play")[0].textContent=nowPlay+arrayWithSongsName[counter].innerText;document.getElementsByClassName("player")[0].src="../storage/app/UsersMusic/<?= Auth::user()->name ?>/"+
arrayWithSongsName[counter].innerText;document.cookie="idSong="+counter;};var pastSong=document.getElementById('pastSong');pastSong.addEventListener('click',past);
            </script>
        @endsection
    @endauth
@endsection
