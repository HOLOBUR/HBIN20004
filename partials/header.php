<?php
	session_start();
	if (!$_SESSION['login']) {
		$dirname = $_SERVER['REQUEST_URI'];

		if (substr($dirname, -1) != '/') {
			$dirname=dirname($dirname).'/';
		} else {
			$dirname = preg_replace('~/+~', '/', $dirname);
		}

		header("Location: ".$dirname."../login.php?redirect=overrides\partials\header.php");
	}
?>
<header class="md-header" data-md-component="header">
  <nav class="md-header-nav md-grid" aria-label="{{ lang.t('header.title') }}">
    <a href="{{ config.site_url | default(nav.homepage.url, true) | url }}" title="{{ config.site_name | e }}" class="md-header-nav__button md-logo" aria-label="{{ config.site_name }}">
      {% include "partials/logo.php" %}
    </a>
    <label class="md-header-nav__button md-icon" for="__drawer">
      {% include ".icons/material/menu" ~ ".svg" %}
    </label>
    <div class="md-header-nav__title" data-md-component="header-title">
      {% if config.site_name == page.title %}
        <div class="md-header-nav__ellipsis md-ellipsis">
          {{ config.site_name }}
        </div>
      {% else %}
        <div class="md-header-nav__ellipsis">
          <span class="md-header-nav__topic md-ellipsis">
            {{ config.site_name }}
          </span>
          <span class="md-header-nav__topic md-ellipsis">
            {% if page and page.meta and page.meta.title %}
              {{ page.meta.title }}
            {% else %}
              {{ page.title }}
            {% endif %}
          </span>
        </div>
      {% endif %}
    </div>
    {% if "search" in config["plugins"] %}
      <label class="md-header-nav__button md-icon" for="__search">
        {% include ".icons/material/magnify.svg" %}
      </label>
      {% include "partials/search.php" %}
    {% endif %}
    {% if config.repo_url %}
      <div class="md-header-nav__source">
        {% include "partials/source.php" %}
      </div>
    {% endif %}
  </nav>
</header>
