var modules = document.querySelectorAll('[megatron-module="helloworld"]');
//[0].
for (var i in modules) {
  modules[i].innerHTML = 'Hello world';;
}
//document.getElementById('helloworld').innerHTML = 'Hello world';
