<section data-component="animated-logo">
	<div>
		<img class="logo-animated-in" src="/public/files/client/images/logo-short.animated.svg" alt="">
	</div>
</section>
<style>
	/**
 * 
 * svg.logo-animated 
 * 
 */
.logo-animated-in {
		opacity: 0;
    animation: animation-scale-in 1.2s linear 0s forwards infinite;
}
.logo-animated-out {
    animation: animation-scale-out .8s linear 0s forwards 1;
}
@keyframes animation-scale-in {
  0% {
    opacity: .4;
    transform: scale(1);
  }

  50% {
    opacity: 1;
    transform: scale(1);
  }

  100% {
    opacity: .4;
    transform: scale(1);
  }
}
@keyframes animation-scale-out {
  0% {
    opacity: .6;
    transform: scale(1);
  }

  50% {
    opacity: 1;
    transform: scale(1);
  }

  100% {
    opacity: 0;
    transform: scale(.95);
  }
}
</style>