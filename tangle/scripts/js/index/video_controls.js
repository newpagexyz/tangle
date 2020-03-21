window.onload=function(){
	setTimeout(start_video,3000);
	var hv=main_video.innerHeight;
	console.log(main_video.innerHeight);
	var otstup=(window.innerHeight-hv)/2
	document.getElementById("main_video").style.top = "1100px"
}
var key=1;
function start_video(){
	main_video.play();
}
main_video.onclick=function(){
	main_video.muted =false;
}
window.addEventListener('scroll', function() {
	
	main_video.style.opacity=(window.innerHeight-pageYOffset)/window.innerHeight;
	if(window.innerHeight/pageYOffset<5)
	{
		//console.log('pause'+window.innerHeight/pageYOffset);
		//main_video.style.opacity=0;
		main_video.pause();                //скрол
		
	}
	else{
		//main_video.style.opacity=1;
		//console.log('play'+window.innerHeight/pageYOffset);
		main_video.play();
		
	}
});
