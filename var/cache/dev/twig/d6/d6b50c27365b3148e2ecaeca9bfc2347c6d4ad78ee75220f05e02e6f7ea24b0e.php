<?php

/* index.html.twig */
class __TwigTemplate_4ddaf73752fff48efbf8a9362b0b954028b35db5f63c5ac5f56c04932c83d721 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 5
        $this->parent = $this->loadTemplate("base.html.twig", "index.html.twig", 5);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 7
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 8
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 12, $this->source); })()), "user", array()) == null)) {
            // line 13
            echo "\t\t<a href=\"/login\" class=\"btn btn-info\"> You need to login >></a>
\t";
        }
        // line 15
        echo "
\t";
        // line 16
        if ((twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 16, $this->source); })()), "user", array()) != null)) {
            // line 17
            echo "        Utilisateur courant : ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new Twig_Error_Runtime('Variable "app" does not exist.', 17, $this->source); })()), "user", array()), "username", array()), "html", null, true);
            echo " <input type=\"button\" onclick=\"location.href='/logout';\" value=\"Déconnexion\" />
        <p> Pour ajouter un évènement à votre calendrier
        <input type=\"button\" onclick=\"location.href='/evenement/ajouter';\" value=\"Ajouter un évènement\" />
        <br/>
        <p> Pour visualiser vos performances
        <input type=\"button\" onclick=\"location.href='/visu/perf';\" value=\"Visualiser\" />
        <br/>
        <p> Pour créer une performance
        <input type=\"button\" onclick=\"location.href='/performance';\" value=\"Créer\" />
        <br/>

        ";
            // line 28
            if (((isset($context["allAbsence"]) || array_key_exists("allAbsence", $context) ? $context["allAbsence"] : (function () { throw new Twig_Error_Runtime('Variable "allAbsence" does not exist.', 28, $this->source); })()) == null)) {
                // line 29
                echo "            <p> Aucun évènement de prévu </p>
        ";
            }
            // line 31
            echo "        ";
            if (((isset($context["allAbsence"]) || array_key_exists("allAbsence", $context) ? $context["allAbsence"] : (function () { throw new Twig_Error_Runtime('Variable "allAbsence" does not exist.', 31, $this->source); })()) != null)) {
                // line 32
                echo "        <table>
                <tr>
                    <th>Nom</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>

                ";
                // line 39
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["allAbsence"]) || array_key_exists("allAbsence", $context) ? $context["allAbsence"] : (function () { throw new Twig_Error_Runtime('Variable "allAbsence" does not exist.', 39, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["absence"]) {
                    // line 40
                    echo "                    <tr>
                        <td>";
                    // line 41
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["absence"], "absNom", array()), "html", null, true);
                    echo "</td>
                        <td>";
                    // line 42
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["absence"], "absDatedebut", array()), "d/m/Y"), "html", null, true);
                    echo "</td>
                        <td>";
                    // line 43
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["absence"], "absDatefin", array()), "d/m/Y"), "html", null, true);
                    echo "</td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['absence'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 46
                echo "            </table>
        ";
            }
            // line 48
            echo "

\t";
        }
        // line 51
        echo "\t
\t
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 51,  149 => 48,  145 => 46,  136 => 43,  132 => 42,  128 => 41,  125 => 40,  121 => 39,  112 => 32,  109 => 31,  105 => 29,  103 => 28,  88 => 17,  86 => 16,  83 => 15,  79 => 13,  76 => 12,  67 => 11,  54 => 8,  45 => 7,  15 => 5,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#  L'échappement de données (output escaping) est automatique avec Symfony / Twig 
    Il n'est pas nécessaire d'écrite  {{ value|escape }} 
    http://symfony.com/doc/current/templating.html#output-escaping
#}
{% extends 'base.html.twig' %}

{% block stylesheets %}
    {{ parent() }}
{% endblock %}

{% block body %}
    {% if app.user == null %}
\t\t<a href=\"/login\" class=\"btn btn-info\"> You need to login >></a>
\t{% endif %}

\t{% if app.user != null %}
        Utilisateur courant : {{ app.user.username }} <input type=\"button\" onclick=\"location.href='/logout';\" value=\"Déconnexion\" />
        <p> Pour ajouter un évènement à votre calendrier
        <input type=\"button\" onclick=\"location.href='/evenement/ajouter';\" value=\"Ajouter un évènement\" />
        <br/>
        <p> Pour visualiser vos performances
        <input type=\"button\" onclick=\"location.href='/visu/perf';\" value=\"Visualiser\" />
        <br/>
        <p> Pour créer une performance
        <input type=\"button\" onclick=\"location.href='/performance';\" value=\"Créer\" />
        <br/>

        {% if allAbsence == null %}
            <p> Aucun évènement de prévu </p>
        {% endif %}
        {% if allAbsence != null %}
        <table>
                <tr>
                    <th>Nom</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>

                {% for absence in allAbsence %}
                    <tr>
                        <td>{{ absence.absNom }}</td>
                        <td>{{ absence.absDatedebut|date(\"d/m/Y\") }}</td>
                        <td>{{ absence.absDatefin|date(\"d/m/Y\") }}</td>
                    </tr>
                {% endfor %}
            </table>
        {% endif %}


\t{% endif %}
\t
\t
{% endblock %}", "index.html.twig", "/home/vml/app_project2/appsuivi/templates/index.html.twig");
    }
}
