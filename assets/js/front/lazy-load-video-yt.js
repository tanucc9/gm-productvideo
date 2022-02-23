var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

let player;
let currentIconStartPlayer;

jQuery(".gm_pv_preview_video").on("click", function() {

   if (currentIconStartPlayer) {
      currentIconStartPlayer.show();
   }
   removeActualVideo();

   const embedCode = jQuery(this).attr("data-embed-code");
   const containerVideo = jQuery(this).parent().find(".gm_pv_video").attr('id');

   player = new YT.Player(containerVideo, {
      height: '100%',
      width: '100%',
      videoId: embedCode,
      events: {
         'onReady': onPlayerReady,
      }
   });

   currentIconStartPlayer = jQuery(this);
   jQuery(this).hide();
});

function onPlayerReady(event) {
   event.target.playVideo();
}

function removeActualVideo() {
   if (player) {
      player.destroy();
   }
}