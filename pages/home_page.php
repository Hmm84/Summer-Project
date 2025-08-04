<?php
include("../include/init.php"); 

echoHeader("Home page", "libraryBody"); 

echo "
    <div class='roomWrapper'> 
        <div class='room'>
            <div class='wall left-wall'>
                <div class='square' style='transform: translate(-91px, -227px); order: 1;'>
                    <a href='home_page.php'>
                    <img class='img-poster'src='../images/fireplace.jpg'
                    style='width: 100%; height: 100%; object-fit: cover; ' />
                    </a>
                </div>

                <div class='poster' style=' height: 251px; width: 137px; transform: translate(61px, 16px);' >
                    <img class='img-poster'src='../images/squirrel in poster.jpg'/>
                </div>

                <div class='poster' style='transform: translate(14px, -238px);' >
                    <img class='img-poster'src='../images/kabaa.jpg'  />
                </div>
                <div class='poster' style='transform: translate(-45px, -26px);;'>
                    <img class='img-poster'src='../images/kitten_pari.jpg'  />
                </div>
        </div>

        <div class='wall center-wall'>
            <div class='fireplace'></div>
            <div class='clock'></div>
            <div class='lamp'></div>
            <div class='library-door' onclick='goToLibrary()>Library</div>
            <div id='continueBox' class='continue-message' style='display: none;'>
                <p> You were reading <span id='chapterName'></span> Do you want to continue? </p>
                <button onclick='continueStory()'> Yes </button>
                <button onclick='startNew()'> No </button>
            </div>
        </div>

    <div class='wall right-wall'>
        <div class='poster' style='height: 255px; width: 323px; transform: translate(62px, -239px);'>
        <h1> HOW TO PLAY </h1> 
        </div>

        <div class='square' style='transform: translate(-5px, 16px);'>
            <img class='img-poster'src='../images/kitten_heart.jpg' />
        </div>
        <div class='poster' style='transform: translate(40px, -66px);'>
            <img class='img-poster'src='../images/beach.jpg' />
            </a>
        </div>

        <div class='poster' style='transform: translate(-201px, -285px);' >
            <img class='img-poster'src='../images/totoro.jpg'  />
        </div>
        </div>
    </div>

    <div class='floor'>
        <div class='rug'>
        <div class='rug in'></div>
        </div>
    </div>
</div>
    <script> 
        function goToLibrary(){
        const lastChapter = localStorage.getItem('libaray_lastChapter'); 

        if(lastChapter){
            document.getElementById('continueBox').style.display='block'; 
            document.getElementById('chapterName').textContent = 'Chapter ' + lastChapter}; 
        } else {
            window.location.href = `chapter.html?storyId=library&chapter=1`; 
        }

        function continueStory() {
        const chapter = localStorage.getItem('library_lastChapter');
        window.location.href = 'chapter.html?storyId=library&chapter='+ chapter;
        }

        function startNew() {
        localStorage.removeItem('library_lastChapter');
        window.location.href = `chapter.html?storyId=library&chapter=1`;
        }
    </script>
    "; 
