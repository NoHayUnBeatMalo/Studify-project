const stopwatch = document.getElementById('stopwatch')
const playPauseButton = document.getElementById('play-pause')
const secondSphere = document.getElementById('seconds-sphere')

let stopwatchInterval;
let runningTime = 0;

const playPause = () => {
    const isPaused = !playPauseButton.classList.contains('running');
    console.log(isPaused)
    if(isPaused){
        playPauseButton.classList.add('running')
        start();
    }else{
        playPauseButton.classList.remove('running')
        pause();
    }
}

const start = () => {
    secondSphere.style.animation = 'rotacion 60s linear infinite';
    let startTime = Date.now() - runningTime;
    secondSphere.style.animationPlayState = 'running';
    stopwatchInterval = setInterval(() => {
        runningTime = Date.now() - startTime;
        stopwatch.textContent = calculateTime(runningTime)
        
    }, 1000);

}
const pause = () => {
    secondSphere.style.animation = 'paused';
    clearInterval(stopwatchInterval);
    
}
const stop = () => {
    secondSphere.style.transform = 'rotate(-90deg) translateX(60px)';
    secondSphere.style.animation = 'none';
    playPauseButton.classList.remove('running')
    runningTime = 0;
    clearInterval(stopwatchInterval)
    stopwatch.textContent = '00:00';
    
}
const calculateTime = runningTime=>{
const totalSeconds = Math.floor(runningTime/1000)
const totalMinutes = Math.floor(totalSeconds/60)
const displaySeconds = (totalSeconds % 60).toString().padStart(2, "0")

const displayMinutes = totalMinutes.toString().padStart(2, "0")
return `${displayMinutes}:${displaySeconds}`;
}