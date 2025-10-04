<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Courses;
use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $firstname = ['Dupont', 'Martin', 'Durand', 'Petit', 'Lemoine'];
        $lastname = ['Pierre', 'Jean', 'Lucie', 'Sophie', 'Claire'];
        for ($i = 0; $i < count($firstname); $i++) {
            $user = new Users();
            $user->setEmail(strtolower($lastname[$i]) . '.' . strtolower($firstname[$i]) . '@e-school.fr');
            $user->setRoles(['ROLE_USER']);
            $password = strtolower($firstname[$i]) . '7791';
            $passwd = $this->hasher->hashPassword($user, $password);
            $user->setPassword($passwd);
            $user->setLastname($firstname[$i]);
            $user->setFirstname($lastname[$i]);
            $manager->persist($user);
        }
        
        $categories = [
            ['name' => 'Back-End'],
            ['name' => 'Front-End'],
        ];
        $categoryEntities = [];
        foreach ($categories as $category) {
            $categoryEntity = new Categories();
            $categoryEntity->setName($category['name']);
            $manager->persist($categoryEntity);
            $categoryEntities[$category['name']] = $categoryEntity;
        }
        
        $coursData = [
            [
                'title' => 'HTML',
                'duration' => 60,
                'content' => 25,
                'price' => 200.0,
                'description' => '
                <h2 class="p-2">Présentation de la formation</h2>
                	<p>Notre formation en développement HTML couvre les concepts fondamentaux tels que les balises, la structure
                		d\'une page web, l\'intégration de médias et bien plus. Ce parcours est pensé pour les débutants ou ceux
                		qui souhaitent renforcer leurs bases.</p>

                	<h2>Modules de la formation</h2>
                	<div>
                		<details class="p-3">
                			<summary>Introduction au HTML : bases et historique</summary>
                			<p>Une introduction complète au HTML, couvrant son historique, son importance et ses bases essentielles.</p>
                		</details>
                		<details class="p-3">
                			<summary>Structuration des pages web : utilisation des balises sémantiques</summary>
                			<p>Découvrez comment structurer vos pages web de manière claire et accessible en utilisant des balises sémantiques.</p>
                		</details>
                		<details class="p-3">
                			<summary>Gestion des images et des liens hypertextes</summary>
                			<p>Apprenez à intégrer des images et à créer des liens hypertextes pour rendre vos pages interactives.</p>
                		</details>
                		<details class="p-3">
                			<summary>Gestion des Formulaires HTML</summary>
                			<p>Découvrez comment concevoir des formulaires efficaces pour collecter des données utilisateur.</p>
                		</details>
                		<details class="p-3">
                			<summary>Mise en forme avancée avec CSS intégré au HTML</summary>
                			<p>Explorez les techniques de mise en forme avancée en combinant HTML et CSS pour des designs modernes.</p>
                		</details>
                	</div>
                	<div>
                	    <h2 class="p-2">Les prérequis de la formation</h2>
                	<ul>
                		<li>Aucune connaissance préalable n est requise, on part de 0 !</li>
                		<li>Une curiosité et une motivation pour apprendre le développement web.</li>
                		<li>Avoir un ordinateur Windows, Mac OS ou Linux !</li>
                		<li>Un éditeur de texte comme Visual Studio Code</li>
                	</ul>
                	<p>C\'est tout !</p></div>
                    <div class="container mt-4 p-2 shadow-sm">
                            <h2 class="p-2">Le Formateur</h2>
                            <p>Notre formation est animée par Jean François, expert en CSS avec plus de 10 ans d\'expérience dans la création de sites web modernes et performants. Son approche pédagogique est centrée sur :</p>

                            <ul>
                                <li>La Pratique : Chaque module inclut des exercices pratiques pour vous permettre de mettre en œuvre les concepts appris.</li>
                                <li>La Simplicité : Des explications claires, accessibles aux débutants.</li>
                                <li>L\'Interactivité : Le formateur est disponible pour répondre à vos questions et vous guider tout au long de la formation.</li>
                            </ul>
                        </div>
                ',
                'document_link' => 'https://e-school.fr/html.pdf',
                'introduction' => '
                <ul class="list-unstyled">
                    <li class="fs-2 text-secondary-emphasis">Structure de base d\'une page web</li>
                    <li class="fs-2 text-secondary-emphasis">Balises HTML, éléments de texte, liens, images</li>
                    <li class="fs-2 text-secondary-emphasis">Formulaires et formulaires interactifs</li>
                    <li class="fs-2 text-secondary-emphasis">SEO de base avec HTML</li>
                </ul>
                
                ',
                'category' => 'Front-End',
            ],
            [
                'title' => 'CSS',
                'duration' => 60,
                'content' => 30,
                'price' => 200.00,
                'description' => '
                <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Présentation de la formation</h2>
                            <p>Notre formation en CSS vous apprendra à styliser vos pages web de manière professionnelle en utilisant les dernières techniques et propriétés CSS.</p>

                            <h2>Modules de la formation</h2>
                            <div>
                                <details class="p-3">
                                    <summary>Introduction au CSS : syntaxe et sélecteurs</summary>
                                    <p>Apprenez la syntaxe de base du CSS et comment sélectionner les éléments à styliser sur vos pages web.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Mise en forme des textes et des polices</summary>
                                    <p>Découvrez comment appliquer des styles aux textes et travailler avec les différentes propriétés de police.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Création de mises en page avec Flexbox</summary>
                                    <p>Apprenez à organiser les éléments sur une page web à l\'aide de Flexbox pour des mises en page modernes et flexibles.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Responsive Design : Adapter votre site à tous les écrans</summary>
                                    <p>Comprenez les principes du design responsive et comment utiliser les media queries pour garantir une expérience utilisateur optimale sur tous les appareils.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Animation et transitions CSS</summary>
                                    <p>Apprenez à ajouter des animations et des transitions pour rendre votre site web interactif et dynamique.</p>
                                </details>
                            </div>
                        </div>

                        <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Les prérequis de la formation</h2>
                            <ul>
                                <li>Aucune connaissance préalable n\'est requise, on part de zéro !</li>
                                <li>Une curiosité et une motivation pour apprendre le développement web.</li>
                                <li>Avoir un ordinateur Windows, Mac OS ou Linux !</li>
                                <li>Un éditeur de texte comme Visual Studio Code</li>
                            </ul>
                            <p>C\'est tout !</p>
                        </div>

                        <div class="container mt-4 p-2 shadow-sm">
                            <h2 class="p-2">Le Formateur</h2>
                            <p>Notre formation est animée par Patrick Souvene, expert en CSS avec plus de 10 ans d\'expérience dans la création de sites web modernes et performants. Son approche pédagogique est centrée sur :</p>

                            <ul>
                                <li>La Pratique : Chaque module inclut des exercices pratiques pour vous permettre de mettre en œuvre les concepts appris.</li>
                                <li>La Simplicité : Des explications claires, accessibles aux débutants.</li>
                                <li>L\'Interactivité : Le formateur est disponible pour répondre à vos questions et vous guider tout au long de la formation.</li>
                            </ul>
                        </div>
                ',
                'document_link' => 'https://e-school/css.pdf',
                'introduction' => '
                <ul class="list-unstyled">
                    <li class="fs-2 text-secondary-emphasis">Mise en forme des éléments</li>
                    <li class="fs-2 text-secondary-emphasis">Layouts (flexbox, grid, etc.)</li>
                    <li class="fs-2 text-secondary-emphasis">Responsive et design adaptatif (mobile-first)</li>
                    <li class="fs-2 text-secondary-emphasis">Animations et transitions CSS</li>
                    <li class="fs-2 text-secondary-emphasis">Préprocesseurs CSS (ex. : Sass ou LESS)</li>
                </ul>
                ',
                'category' => 'Front-End',
            ],
            [
                'title' => 'JAVASCRIPT',
                'duration' => 75,
                'content' => 30,
                'price' => 300.00,
                'description' => '
                <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Présentation de la formation</h2>
                            <p>Notre formation en JavaScript vous apprendra à rendre vos pages web dynamiques et interactives avec l\'utilisation des dernières techniques JavaScript.</p>

                            <h2>Modules de la formation</h2>
                            <div>
                                <details class="p-3">
                                    <summary>Introduction à JavaScript : syntaxe et variables</summary>
                                    <p>Apprenez les bases du langage JavaScript, y compris les types de données, les variables, et la syntaxe de base.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Les fonctions en JavaScript</summary>
                                    <p>Découvrez comment déclarer et utiliser des fonctions pour structurer votre code efficacement.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Manipulation du DOM avec JavaScript</summary>
                                    <p>Apprenez à interagir avec le DOM pour modifier dynamiquement le contenu d\'une page web.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Les événements en JavaScript</summary>
                                    <p>Maîtrisez la gestion des événements pour rendre vos pages web interactives (clics, saisie clavier, etc.).</p>
                                </details>
                                <details class="p-3">
                                    <summary>Les promesses et l\'Asynchrone en JavaScript</summary>
                                    <p>Comprenez les mécanismes des promesses, des async/await, et comment gérer les opérations asynchrones dans votre code.</p>
                                </details>
                            </div>
                        </div>

                        <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Les prérequis de la formation</h2>
                            <ul>
                                <li>Aucune connaissance préalable n\'est requise, on part de zéro !</li>
                                <li>Une curiosité et une motivation pour apprendre le développement web et le JavaScript.</li>
                                <li>Avoir un ordinateur Windows, Mac OS ou Linux !</li>
                                <li>Un éditeur de texte comme Visual Studio Code</li>
                            </ul>
                            <p>C\'est tout !</p>
                        </div>

                        <div class="container mt-4 p-2 shadow-sm">
                            <h2 class="p-2">Le Formateur</h2>
                            <p>Notre formation est animée par Alice picarte, expert en JavaScript avec plus de 10 ans d\'expérience dans le développement d\'applications web modernes. Son approche pédagogique est centrée sur :</p>

                            <ul>
                                <li>La Pratique : Chaque module inclut des exercices pratiques pour vous permettre de mettre en œuvre les concepts appris.</li>
                                <li>La Simplicité : Des explications claires, accessibles aux débutants.</li>
                                <li>L\'Interactivité : Le formateur est disponible pour répondre à vos questions et vous guider tout au long de la formation.</li>
                            </ul>
                        </div>
                ',
                'document_link' => 'https://e-school/javascript.pdf',
                'introduction' => '
                <ul class="list-unstyled">
                    <li class="fs-2 text-secondary-emphasis">Syntaxe de base, variables, fonctions, boucles</li>
                    <li class="fs-2 text-secondary-emphasis">Manipulation du DOM (Document Object Model)</li>
                    <li class="fs-2 text-secondary-emphasis">Événements et gestion des interactions
                                utilisateurs
                    </li>
                    <li class="fs-2 text-secondary-emphasis">Introduction aux frameworks JavaScript (ex. : React
                                ou Vue.js)
                    </li>
                </ul>
                ',
                'category' => 'Front-End',
            ],
            [
                'title' => 'PYTHON',
                'duration' => 60,
                'content' => 25,
                'price' => 350.00,
                'description' => '
                <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Présentation de la formation</h2>
                            <p>Notre formation Python vous apprendra à coder en Python pour des applications variées telles que le développement web, l\'analyse de données, l\'automatisation des tâches et bien plus.</p>

                            <h2>Modules de la formation</h2>
                            <div>
                                <details class="p-3">
                                    <summary>Introduction à Python : syntaxe et structures de données</summary>
                                    <p>Découvrez les bases du langage Python, les types de données (listes, dictionnaires, tuples) et les structures de contrôle.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Les fonctions et l\'orienté objet</summary>
                                    <p>Apprenez à structurer votre code avec des fonctions et à utiliser la programmation orientée objet pour une meilleure organisation.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Manipulation des fichiers et gestion des erreurs</summary>
                                    <p>Apprenez à manipuler des fichiers et gérer les erreurs dans vos scripts Python pour des programmes robustes.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Bibliothèques Python pour le web et l\'analyse de données</summary>
                                    <p>Découvrez les bibliothèques populaires comme Flask pour le développement web, et Pandas et NumPy pour l\'analyse de données.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Automatisation et scripts Python</summary>
                                    <p>Apprenez à automatiser des tâches répétitives avec Python pour rendre vos processus plus efficaces.</p>
                                </details>
                            </div>
                        </div>

                        <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Les prérequis de la formation</h2>
                            <ul>
                                <li>Aucune connaissance préalable en programmation n\'est requise.</li>
                                <li>Une volonté d\'apprendre et de s\'investir dans la programmation.</li>
                                <li>Un ordinateur avec Python installé (instructions fournies dans la formation).</li>
                            </ul>
                            <p>Cette formation est accessible à tous, débutants ou personnes cherchant à approfondir leurs compétences en programmation Python.</p>
                        </div>

                        <div class="container mt-4 p-2 shadow-sm">
                            <h2 class="p-2">Le Formateur</h2>
                            <p>Notre formation est animée par Joachim sésar, un expert Python avec plus de 10 ans d\'expérience dans le développement d\'applications variées et l\'analyse de données. Vous serez accompagné tout au long de la formation pour garantir une progression optimale.</p>

                            <ul>
                                <li>Approche pratique et interactive avec des exercices réels.</li>
                                <li>Explication claire et détaillée des concepts Python.</li>
                                <li>Support continu et sessions de questions-réponses pour répondre à vos besoins spécifiques.</li>
                            </ul>
                        </div>
                ',
                'document_link' => 'https://e-school/python.pdf',
                'introduction' => '
                <ul class="list-unstyled">
                    <li class="fs-2 text-secondary-emphasis">Python de base</li>
                    <li class="fs-2 text-secondary-emphasis">Frameworks Python</li>
                    <li class="fs-2 text-secondary-emphasis">Bibliothèques Python</li>
                </ul>
                ',
                'category' => 'Back-End',
            ],
            [
                'title' => 'PHP',
                'duration' => 60,
                'content' => 25,
                'price' => 350.00,
                'description' => '
                <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Présentation de la formation</h2>
                            <p>Notre formation PHP vous apprendra à créer des applications web dynamiques, en utilisant le PHP pour interagir avec des bases de données, gérer les formulaires, et gérer les sessions utilisateurs.</p>

                            <h2>Modules de la formation</h2>
                            <div>
                                <details class="p-3">
                                    <summary>Introduction au PHP : syntaxe et variables</summary>
                                    <p>Découvrez les bases du PHP, y compris les variables, les types de données, et la syntaxe du langage.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Les fonctions et les structures conditionnelles</summary>
                                    <p>Apprenez à structurer votre code en PHP avec les fonctions, les conditions (if, switch), et les boucles.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Les formulaires et la gestion des données utilisateurs</summary>
                                    <p>Apprenez à manipuler les formulaires, valider les entrées des utilisateurs et gérer les données soumises.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Connexion à une base de données avec MySQL</summary>
                                    <p>Apprenez à interagir avec une base de données MySQL pour stocker et récupérer des données.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Gestion des sessions et sécurité</summary>
                                    <p>Comprenez les mécanismes des sessions PHP pour gérer les utilisateurs et la sécurité des applications web.</p>
                                </details>
                            </div>
                        </div>

                        <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Les prérequis de la formation</h2>
                            <ul>
                                <li>Aucune connaissance préalable n\'est requise, nous couvrons les bases !</li>
                                <li>Une volonté d\'apprendre et de s\'investir dans le développement web.</li>
                                <li>Avoir un ordinateur Windows, Mac OS ou Linux avec un serveur local (comme XAMPP ou WAMP).</li>
                            </ul>
                            <p>Les notions de base en HTML et CSS sont un plus mais ne sont pas indispensables pour suivre cette formation.</p>
                        </div>

                        <div class="container mt-4 p-2 shadow-sm">
                            <h2 class="p-2">Le Formateur</h2>
                            <p>Notre formation est animée par Jules Pages, expert PHP avec plus de 10 ans d\'expérience dans le développement d\'applications web complexes. Il vous guidera pas à pas à travers chaque concept de la formation, de l\'introduction au PHP à la gestion des bases de données et de la sécurité des applications.</p>

                            <ul>
                                <li>Approche pratique et interactive avec des exercices réels.</li>
                                <li>Explication claire et détaillée des concepts PHP.</li>
                                <li>Support continu et sessions de questions-réponses pour répondre à vos besoins spécifiques.</li>
                            </ul>
                        </div>
                ',
                'document_link' => 'https://e-school/php.pdf',
                'introduction' => '
                <ul class="list-unstyled">
                    <li class="fs-2 text-secondary-emphasis">PHP de base</li>
                    <li class="fs-2 text-secondary-emphasis">Bases de données avec PHP et MySQL</li>
                    <li class="fs-2 text-secondary-emphasis">Frameworks PHP</li>
                </ul>
                ',
                'category' => 'Back-End',
            ],
            [
                'title' => 'JAVA',
                'duration' => 80,
                'content' => 40,
                'price' => 350.00,
                'description' => '
                <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Présentation de la formation</h2>
                            <p>Notre formation en Java vous apprendra à créer des applications logicielles avec un code propre et bien structuré. Vous apprendrez à utiliser les concepts clés du langage Java pour le développement d\'applications web et mobiles.</p>

                            <h2>Modules de la formation</h2>
                            <div>
                                <details class="p-3">
                                    <summary>Introduction au langage Java</summary>
                                    <p>Apprenez les bases du langage Java, y compris la syntaxe, les variables, et les types de données.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Les structures de contrôle</summary>
                                    <p>Comprenez les boucles, les conditions, et comment contrôler le flux de votre programme.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Programmation orientée objet (POO)</summary>
                                    <p>Découvrez les concepts de la POO, tels que les classes, objets, héritage, et polymorphisme.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Gestion des exceptions</summary>
                                    <p>Apprenez à gérer les erreurs et exceptions pour rendre vos applications plus robustes.</p>
                                </details>
                                <details class="p-3">
                                    <summary>Développement d\'applications Java EE</summary>
                                    <p>Découvrez comment créer des applications web avec Java EE (Enterprise Edition) et intégrer des bases de données.</p>
                                </details>
                            </div>
                        </div>

                        <div class="container mt-4 shadow-sm">
                            <h2 class="p-2">Les prérequis de la formation</h2>
                            <ul>
                                <li>Aucune connaissance préalable n\'est requise, nous commençons par les bases du Java !</li>
                                <li>Une curiosité et une motivation pour apprendre le développement logiciel.</li>
                                <li>Avoir un ordinateur avec Java installé (Windows, Mac OS, ou Linux).</li>
                                <li>Un éditeur de texte comme IntelliJ IDEA ou Eclipse.</li>
                            </ul>
                            <p>C\'est tout !</p>
                        </div>

                        <div class="container mt-4 p-2 shadow-sm">
                            <h2 class="p-2">Le Formateur</h2>
                            <p>Notre formation est animée par <strong class="text-secodary">Benjamin</strong> fenetre, expert en Java avec plus de 15 ans d\'expérience dans le développement d\'applications. Son approche pédagogique est centrée sur :</p>

                            <ul>
                                <li>La Pratique : Chaque module comprend des exercices pratiques pour mettre en application les concepts appris.</li>
                                <li>La Simplicité : Des explications claires, accessibles aux débutants en programmation.</li>
                                <li>L\'Interactivité : Le formateur est disponible pour répondre à vos questions et vous guider tout au long de la formation.</li>
                            </ul>
                        </div>
                ',
                'document_link' => 'https://e-school/symfony.pdf',
                'introduction' => '
                <ul class="list-unstyled">
                    <li class="fs-2 text-secondary-emphasis">Introduction à Java</li>
                    <li class="fs-2 text-secondary-emphasis">Programmation orientée objet (POO)</li>
                    <li class="fs-2 text-secondary-emphasis">Spring Framework</li>
                </ul>
                ',
                'category' => 'Back-End',
            ]
        ];
        foreach ($coursData as $cours) {
            $courseEntity = new Courses();
            $courseEntity->setTitle($cours['title']);
            $courseEntity->setDuration($cours['duration']);
            $courseEntity->setContent($cours['content']);
            $courseEntity->setPrice($cours['price']);
            $courseEntity->setDescription($cours['description']);
            $courseEntity->setDocumentLink($cours['document_link']);
            $courseEntity->setIntroduction($cours['introduction']);
            $courseEntity->addCategory($categoryEntities[$cours['category']]);
            $manager->persist($courseEntity);
        }

        $manager->flush();
    }
}
