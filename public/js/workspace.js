// pour le menu lorsque je click sous menu apparait

/* document.addEventListener('DOMContentLoaded', function() {
    // Gestion du clic pour ouvrir/fermer les sous-menus
    document.querySelectorAll('#sidebar .nav-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            const submenuId = this.id.replace('-toggle', '-menu');
            const submenu = document.getElementById(submenuId);

            if (submenu) {
                event.preventDefault();
                submenu.classList.toggle('collapse');
            }
        });
    });
});  */






// en JavaScript
/* document.addEventListener('DOMContentLoaded', function() {

    // Fonction pour afficher le formulaire
    function displayForm(url, formId) {
        const workspaceContainer = document.querySelector('.containerWorkspace');
        const originalContent = workspaceContainer.innerHTML; // Sauvegarder le contenu original

        // Utilisation de XMLHttpRequest pour faire une requête Ajax
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                workspaceContainer.innerHTML = xhr.responseText; // Insérer le HTML du formulaire
                const formElement = document.getElementById(formId);
                if (formElement) {
                    formElement.style.display = 'block'; // Assurer que le formulaire est visible
                }
            } else {
                console.error('Erreur lors du chargement du formulaire:', xhr.statusText);
                workspaceContainer.innerHTML = originalContent; // Restaurer le contenu original en cas d'erreur
            }
        };

        xhr.onerror = function() {
            console.error('Erreur lors de la requête Ajax');
            workspaceContainer.innerHTML = originalContent; // Restaurer le contenu original en cas d'erreur
        };

        xhr.send();
    }

    // Gestion du clic pour ouvrir/fermer les sous-menus
    document.querySelectorAll('#sidebar .nav-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            const submenuId = this.id.replace('-toggle', '-menu');
            const submenu = document.getElementById(submenuId);

            if (submenu) {
                event.preventDefault();

                // Cacher tous les sous-menus sauf celui cliqué
                document.querySelectorAll('#sidebar .nav .collapse').forEach(function(siblingMenu) {
                    if (siblingMenu !== submenu) {
                        siblingMenu.classList.remove('show');
                    }
                });

                // Alterner la visibilité du sous-menu cliqué
                submenu.classList.toggle('show');
            }
        });
    });

    // Gestion du clic pour créer une catégorie
    const createCategoryLink = document.querySelector('#administration-menu a[href="#create-category"]');
    if (createCategoryLink) {
        createCategoryLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de création de catégorie
            displayForm('/workspace/create_category', 'create-category-form');
        });
    }

    // Gestion du clic pour afficher le formulaire de suppression de catégorie
    const deleteCategoryLink = document.querySelector('#administration-menu a[href="#delete-category"]');
    if (deleteCategoryLink) {
        deleteCategoryLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de suppression de catégorie
            displayForm('/workspace/delete_category', 'delete-category-form');
        });
    }

}); */





// public/js/workspace.js en AJAX
document.addEventListener('DOMContentLoaded', function() {

    // Fonction pour afficher le formulaire
    function displayForm(url, formId) {
        const workspaceContainer = document.querySelector('.containerWorkspace');
        const originalContent = workspaceContainer.innerHTML; // Sauvegarder le contenu original

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors du chargement du formulaire: ' + response.statusText);
                }
                return response.text();
            })
            .then(html => {
                workspaceContainer.innerHTML = html; // Insérer le HTML du formulaire
                const formElement = document.getElementById(formId);
                if (formElement) {
                    formElement.style.display = 'block'; // Assurer que le formulaire est visible
                }
            })
            .catch(error => {
                console.error(error);
                workspaceContainer.innerHTML = originalContent; // Restaurer le contenu original en cas d'erreur
            });
    }

    // Gestion du clic pour ouvrir/fermer les sous-menus
    document.querySelectorAll('#sidebar .nav-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            const submenuId = this.id.replace('-toggle', '-menu');
            const submenu = document.getElementById(submenuId);

            if (submenu) {
                event.preventDefault();

                // Cacher tous les sous-menus sauf celui cliqué
                document.querySelectorAll('#sidebar .nav .collapse').forEach(function(siblingMenu) {
                    if (siblingMenu !== submenu) {
                        siblingMenu.classList.remove('show');
                    }
                });

                // Alterner la visibilité du sous-menu cliqué
                submenu.classList.toggle('show');
            }
        });
    });

    // Gestion du clic pour créer une catégorie
    const createCategoryLink = document.querySelector('#administration-menu a[href="#create-category"]');
    if (createCategoryLink) {
        createCategoryLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de création de catégorie
            displayForm('/workspace/create_category', 'create-category-form');
        });
    }

    // Gestion du clic pour afficher le formulaire de suppression de catégorie
    const deleteCategoryLink = document.querySelector('#administration-menu a[href="#delete-category"]');
    if (deleteCategoryLink) {
        deleteCategoryLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de suppression de catégorie
            displayForm('/workspace/delete_category', 'delete-category-form');
        });
    }




    
    const deleteUserLink = document.querySelector('#administration-menu a[href="#delete-user"]');
    if (deleteUserLink) {
        deleteUserLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/delete_user', 'delete-user-form');
        });
    }


    // formulaire ajouter un role utilisateur
    const addRoleUserLink = document.querySelector('#administration-menu a[href="#add-role-user"]');
    if (addRoleUserLink) {
        addRoleUserLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/add_role_user', 'add-user-role-form');
        });
    }

    // formulaire supprimer un role utilisateur
    const removeRoleUserLink = document.querySelector('#administration-menu a[href="#remove-role-user"]');
    if (removeRoleUserLink) {
        removeRoleUserLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/remove_role_user', 'remove-user-role-form');
        });
    }



    // formulaire supprimer un Commentaire
    const deleteCommentLink = document.querySelector('#administration-menu a[href="#delete-comment"]');
    if (deleteCommentLink) {
        deleteCommentLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'administration
            const administrationMenu = document.getElementById('administration-menu');
            if (administrationMenu) {
                administrationMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/delete_comment', 'delete-comment-form');
        });
    }



    // formulaire Creation d'un Quizz
    const createQuizLink = document.querySelector('#academie-menu a[href="#createQuiz"]');
    if (createQuizLink) {
        createQuizLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const academieMenu = document.getElementById('academie-menu');
            if (academieMenu) {
                academieMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/create_quiz', 'create-quiz-form');
        });
    }


    // formulaire Modifier ou supprimer un Quizz
    const indexQuizLink = document.querySelector('#academie-menu a[href="#indexQuiz"]');
    if (indexQuizLink) {
        indexQuizLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const academieMenu = document.getElementById('academie-menu');
            if (academieMenu) {
                academieMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/index_quiz', 'index-quiz-mod-sup');
        });
    }


    
   



    // formulaire Creation d'un Content
    const createContentLink = document.querySelector('#academie-menu a[href="#create-content"]');
    if (createContentLink) {
        createContentLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const academieMenu = document.getElementById('academie-menu');
            if (academieMenu) {
                academieMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/create_content', 'create-content-form');
        });
    }


    // formulaire Modifier ou supprimer un Content
    const indexContentLink = document.querySelector('#academie-menu a[href="#index-content"]');
    if (indexContentLink) {
        indexContentLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const academieMenu = document.getElementById('academie-menu');
            if (academieMenu) {
                academieMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/index_content', 'index-content-mod-sup');
        });
    }







    // formulaire Creation d'un Blog
    const createBlogLink = document.querySelector('#academie-menu a[href="#create-blog"]');
    if (createBlogLink) {
        createBlogLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const academieMenu = document.getElementById('academie-menu');
            if (academieMenu) {
                academieMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/create_blog', 'create-blog-form');
        });
    }


    // formulaire Modifier ou supprimer un Blog
    const indexBlogLink = document.querySelector('#academie-menu a[href="#index-blog"]');
    if (indexBlogLink) {
        indexBlogLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const academieMenu = document.getElementById('academie-menu');
            if (academieMenu) {
                academieMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/index_blog', 'index-blog-mod-sup');
        });
    }





    // Afficher resultat utilisateur 
    const indexResultLink = document.querySelector('#profil-menu a[href="#indexResult"]');
    if (indexResultLink) {
        indexResultLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const profilMenu = document.getElementById('profil-menu');
            if (profilMenu) {
                profilMenu.classList.add('show');
            }

            // Charger le formulaire de suppression d'utilisateur
            displayForm('/workspace/index_result', 'index-show-result');
        });
    }


    // Afficher Profile utilisateur
    const indexUserProfileLink = document.querySelector('#profil-menu a[href="#indexUserProfile"]');
    if (indexUserProfileLink) {
        indexUserProfileLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de rediriger

            // Cacher tout autre contenu éventuel dans containerWorkspace
            const workspaceContainer = document.querySelector('.containerWorkspace');
            workspaceContainer.innerHTML = ''; // Vide le contenu

            // Afficher le sous-menu d'académie
            const profilMenu = document.getElementById('profil-menu');
            if (profilMenu) {
                profilMenu.classList.add('show');
            }

            // Charger l'affichage profil user
            displayForm('/workspace/index_user', 'index-show-user-profile');
        });
    }




}); 





