<template>
    <ul class="nav">
        <li class="nav-item">
            <router-link :to="{ name: 'home'}" tag="a" exact class="nav-link">
                <i class="icon-speedometer"></i>
                Dashboard
            </router-link>
        </li>

        <li class="nav-item nav-dropdown">
            <router-link :to="{ name: 'blog'}" tag="a" exact class="nav-link nav-dropdown-toggle">
                <i class="icon-book-open"></i>
                Blog
            </router-link>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <router-link :to="{ name: 'article'}" active-class="router-link-active active" tag="a" class="nav-link">
                        <i class="icon-pencil"></i>
                        Articles
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'articleCategory'}" active-class="router-link-active active" tag="a" class="nav-link">
                        <i class="icon-tag"></i>
                        Categories
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <router-link :to="{ name: 'workplace'}" tag="a" class="nav-link">
                <i class="icon-user-follow"></i>
                Workplaces
            </router-link>
        </li>

        <!--<li class="nav-item">-->
            <!--<router-link :to="{ name: 'poster'}" tag="a" class="nav-link">-->
                <!--<i class="icon-speech"></i>-->
                <!--Adverts-->
            <!--</router-link>-->
        <!--</li>-->

        <li class="nav-item">
            <router-link :to="{ name: 'page'}" tag="a" class="nav-link">
                <i class="icon-docs"></i>
                Pages
            </router-link>
        </li>


        <li class="nav-item nav-dropdown">
            <router-link :to="{ name: 'formRequests'}" tag="a" exact class="nav-link nav-dropdown-toggle">
                <i class="icon-envelope-letter"></i>
                Form Requests
            </router-link>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <router-link :to="{ name: 'formRequest'}" tag="a" class="nav-link">
                        <i class="icon-envelope"></i>
                        Form requests
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'subscriber'}" tag="a" class="nav-link">
                        <i class="icon-envelope"></i>
                        Subscribers
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'workplaceRequest'}" tag="a" class="nav-link">
                        <i class="icon-envelope"></i>
                        Workplace requests
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'reviews'}" tag="a" class="nav-link">
                        <i class="icon-bubbles"></i>
                        Reviews
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <router-link :to="{ name: 'serviceCenters'}" tag="a" class="nav-link">
                <i class="icon-wrench"></i>
                Service centres
            </router-link>
        </li>

        <li class="nav-item">
            <router-link :to="{ name: 'maintenanceCenters'}" tag="a" class="nav-link">
                <i class="icon-wrench"></i>
                Maintenance Centers
            </router-link>
        </li>

        <li class="nav-item nav-dropdown">
            <router-link :to="{ name: 'schools'}" tag="a" exact class="nav-link nav-dropdown-toggle">
                <i class="icon-docs"></i>
                Schools
            </router-link>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <router-link :to="{ name: 'schools'}" tag="a" class="nav-link">
                        <i class="icon-book-open"></i>
                        Schools
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'schoolCategory'}" tag="a" class="nav-link">
                        <i class="icon-book-open"></i>
                        School categories
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'courses'}" tag="a" class="nav-link">
                        <i class="icon-book-open"></i>
                        Courses
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <router-link :to="{ name: 'user'}" tag="a" class="nav-link">
                <i class="icon-people"></i>
                Users
            </router-link>
        </li>

        <li class="nav-item nav-dropdown">
            <router-link :to="{ name: 'file'}" tag="a" exact class="nav-link nav-dropdown-toggle">
                <i class="icon-docs"></i>
                Files
            </router-link>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <router-link :to="{ name: 'file'}" tag="a" class="nav-link">
                        <i class="icon-docs"></i>
                        Files
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'fileCategory'}" tag="a" class="nav-link">
                        <i class="icon-tag"></i>
                        Categories
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <router-link :to="{ name: 'faq'}" tag="a" class="nav-link">
                <i class="icon-list"></i>
                FAQ
            </router-link>
        </li>

        <li class="nav-item nav-dropdown">
            <router-link :to="{ name: 'product'}" tag="a" exact class="nav-link nav-dropdown-toggle">
                <i class="icon-docs"></i>
                Catalog
            </router-link>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <router-link :to="{ name: 'product'}" tag="a" class="nav-link">
                        <i class="icon-docs"></i>
                        Products
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'productCategory'}" tag="a" class="nav-link">
                        <i class="icon-tag"></i>
                        Categories
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'attribute'}" tag="a" class="nav-link">
                        <i class="icon-docs"></i>
                        Attributes
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'attributeCategory'}" tag="a" class="nav-link">
                        <i class="icon-tag"></i>
                        Attribute Category
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'serial'}" tag="a" class="nav-link">
                        <i class="icon-docs"></i>
                        Series
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item nav-dropdown">
            <router-link :to="{ name: 'country'}" tag="a" exact class="nav-link nav-dropdown-toggle">
                <i class="icon-docs"></i>
                Locations
            </router-link>
            <ul class="nav-dropdown-items">
                <li class="nav-item">
                    <router-link :to="{ name: 'country'}" tag="a" class="nav-link">
                        <i class="icon-user-follow"></i>
                        Countries
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link :to="{ name: 'city'}" tag="a" class="nav-link">
                        <i class="icon-user-follow"></i>
                        Cities
                    </router-link>
                </li>
            </ul>
        </li>

    </ul>
</template>