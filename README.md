# Proyecto
Requerimientos: https://jaortizr.github.io/docs/proyFinal_TWeb_Sem20211.pdf 

Templete a utilizar: https://www.templatemonster.com/website-templates/53534.html

### Por hacer:
- [ ] Crear _branches_ para los dos módulos (admin y estudiante).
- [ ] Definir el [index](index.html).
- [ ] Terminar toda la parte de _front end_ en 2 semanas (14/12/20).

<br>

# Github (team workflow)

Explico un poco desde el principio el workflow que tendremos en Github y lo que tendrían hacer, si es que estan en ceros en GitHub y Git

1. Descargarse e instalarse git
2. Configurar en el git (username, password, etc)
3. Hacerle fork al repo https://github.com/edoomm/proyecto-web (un fork crea una copia del repositorio en tu GitHub)

GitHub te permite trabajar un repositorio de manera local y actualizarlo de manera remota.

# Branches

Los branches sirven para ramificar el repo y que todos puedan estar desarrollando al mismo tiempo distintas funcionalidades, todos ya tenemos como base lo que Ian y yo hemos hecho y ya puedan trabajar en su respectiva página y la pongan bonita y así

- Para crear branches utilizan <br>
`git checkout -b [nombre-branch]`
- Para cambiarse a una branch existente <br>
`git checkout [nombre-branch]`
- Para ver los branches que existen de manera local <br>
`git branch`
- Para ver los branches remotos <br>
`git branch -r`

Una vez que ya esten en la branch correcta, ya pueden realizar todas las operaciones básicas de `git` (`add`, `commit`, `push`, `pull`)

Para el caso del push, tal como viene en la [cheatsheet](https://education.github.com/git-cheat-sheet-education.pdf) oficial de GitHub

> `git push [alias] [branch]`

Usariamos algo como lo que les pongo en ejemplo para dar un push al repo remoto (que sería el que más utilizaríamos) <br>
`git push origin fend-feautre`

## Nomenclatura de branches
Como les dije las branches sirven para ramificar el repo, por lo que traten de simular esto, es decir el nombre de una branch podría quedar de la siguiente manera: <br>
<center>
<i>feature1-feature1.1-feature1.1.1</i>
</center> <br>

Y otra branch, donde se esté trabajando otra funcionalidad distinta, podría quedar como: <br>
<center>
<i>feature1-feature1.1-feature1.1.2</i>
</center> <br>
Por ejemplo , como trabajaremos la parte de _front end_, podríamos tener la branch principal _fend_ y a partir de esta, y dependiendo como se repartan el trabajo, podrían crear otras branches (ramificaciones) que desprendan de _fend_. Poniendo el ejemplo de como Ian y yo quedamos de acuerdo en trabajar:

(Cada uno tendría que crear su branch y trabajar sobre ella)
- _fend-admin-reportes_: Ian
- _fend-admin-alumnos_: Eduardo

Y después estaremos trabajando en la parte de alumnos, y quedarían algo asi nuestras branches, que nos repartiríamos
- _fend-admin-alumnos-editar_
- _fend-admin-alumnos-visualizar_

Y para la parte de alumnos (no sé como la tengan pensada), pero su branch principal sería
<center>
<i> fend-alumno </i>
</center> <br>

Y ya de ahí se podrían desprender todas las funcionalidades que van a implementar, por ejemplo:
- _fend-alumno-login_
- _fend-alumno-menu_
- _fend-alumno-etc_

Una vez ya tengan completa su parte, ya dan pull request con `git push origin fend-feature`

## ¿Y todo esto pa que?
Trabajar en branches, nos va a permitir estar trabajando al mismo tiempo, o cuando cada uno decida y no se tenga problemas por estar actualizando lo que otro ya hizo (para evitar conflictos con los `pull`)

Ya cuando alguien haya terminado y testeado la funcionalidad (_feature_) que está implementando, ya GitHub une casi automaticamente el trabajo que vayamos haciendo <br>

# No olviden
Llevar un estilo de programación similar al de todos, apoyense de recursos como [JSDocs](https://jsdoc.app/), [HTMLDocs](https://devdocs.io/html/) o [PHPManual](https://www.php.net/manual/en/index.php). Para que tengamos la misma nomenclatura en nuestras variables, funciones, etc.

Yo, como propietario del repo, podré ir viendo lo que vayan mandando, ir revisandolo y dandoles retro si algo esta mal

Tampoco olviden andarle dando `push` a lo que vayan trabajando, para que todos podamos ver que todos vamos avanzando

Tambien para las partes de los `&acute`, se me ocurria que trabajaramos con acentos y ya hasta al final hacemos <b> <i> refactor </i> </b> de los caracteres (á, é, ñ, etc) con sus respectivos `&acute` (`&aacute`, `&eacute`, `&ntilde`, etc)