<?php

function echo_player(){ ?>


<script>
  var if_player = true;
</script>

        <div id="white-player">
          <div class="white-player-top">
            <div class="grid-x">
              <div class="large-3 medium-3 small-3 cell">

              </div>
              <div class="large-6 medium-6 small-6 cell">
                <span class="now-playing">Now Playing</span>
              </div>
              <div class="large-3 medium-3 small-3 cell">
                <img src="<?php assets_url('images/player/show-playlist.svg'); ?>" class="show-playlist"/>
              </div>
            </div>
          </div>

          <div id="white-player-center">
            <div class="main-album-art">
              <img amplitude-song-info="cover_art_url" amplitude-main-song-info="true" class=""/>
            </div>
            <div class="song-meta-data">
              <span amplitude-song-info="name" amplitude-main-song-info="true" class="song-name"></span>
              <span amplitude-song-info="artist" amplitude-main-song-info="true" class="song-artist"></span>
            </div>

            <div class="time-progress">
              <div class="grid-x">
                <div class="large-12 medium-12 small-12 cell">
                  <div id="progress-container">
                    <input type="range" class="amplitude-song-slider" amplitude-main-song-slider="true"/>
  				          <progress id="song-played-progress" class="amplitude-song-played-progress" amplitude-main-song-played-progress="true"></progress>
  				          <progress id="song-buffered-progress" class="amplitude-buffered-progress" value="0"></progress>
                  </div>
                </div>
              </div>

              <div class="grid-x">
                <div class="large-6 medium-6 small-6 cell">
                  <span class="current-time">
  				          <span class="amplitude-current-minutes" amplitude-main-current-minutes="true"></span>:<span class="amplitude-current-seconds" amplitude-main-current-seconds="true"></span>
  				        </span>
                </div>
                <div class="large-6 medium-6 small-6 cell">
                  <span class="duration">
  				          <span class="amplitude-duration-minutes" amplitude-main-duration-minutes="true"></span>:<span class="amplitude-duration-seconds" amplitude-main-duration-seconds="true"></span>
  				        </span>
                </div>
              </div>
            </div>
          </div>

          <div id="white-player-controls">
            <div class="grid-x">
              <div class="large-12 medium-12 small-12 cell">
                <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
                <div class="amplitude-prev" id="previous"></div>
                <div class="amplitude-play-pause" amplitude-main-play-pause="true" id="play-pause"></div>
                <div class="amplitude-next" id="next"></div>
                <div class="amplitude-repeat" id="repeat"></div>
              </div>
            </div>
          </div>

          <div id="white-player-playlist-container">
            <div class="white-player-playlist-top">
              <div class="grid-x">
                <div class="large-3 medium-3 small-3 cell">

                </div>
                <div class="large-6 medium-6 small-6 cell">
                  <span class="queue">Queue</span>
                </div>
                <div class="large-3 medium-3 small-3 cell">
                  <img src="<?php assets_url('images/player/close.svg'); ?>" class="close-playlist"/>
                </div>
              </div>
            </div>

            <div class="white-player-playlist">
            </div>

            <div class="white-player-playlist-controls">
              <img amplitude-song-info="cover_art_url" amplitude-main-song-info="true" class="playlist-album-art"/>

              <div class="playlist-controls">
                <div class="grid-x">
                  <div class="large-6 medium-6 small-6 cell">
                    <span amplitude-song-info="name" amplitude-main-song-info="true" class="song-name"></span>
                    <span amplitude-song-info="artist" amplitude-main-song-info="true" class="song-artist"></span>
                  </div>
                  <div class="large-6 medium-6 small-6 cell">
                    <div class="playlist-control-wrapper">
                      <div class="amplitude-prev playlist-previous"></div>
                      <div class="amplitude-play-pause playlist-play-pause" amplitude-main-play-pause="true"></div>
                      <div class="amplitude-next playlist-next"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
      </div>



<?php
}



?>