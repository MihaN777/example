<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/png" href="/img/icons/favicon.png" />

	@yield('styles')

	<title>@yield('title', config('app.name'))</title>
</head>

<body>
	<div class="wrapper">
		{{-- HEADER --}}
		<header class="header">
			<div class="container">
				<div class="header__row">

					<div class="header__logo-col">
						<button class="header__burger-btn" id="burger">
							<span></span><span></span><span></span>
						</button>

						<a href="{{ route('home') }}" class="header__logo-link">
							SITE LOGO
						</a>
					</div>

					<div class="header__nav-col">
						<nav class="header__nav">
							<ul class="header__menu-list">
								<li class="header__menu-item">
									<a href="#!" class="header__menu-link">Item #1</a>
								</li>

								<li class="header__menu-item">
									<a class="header__menu-link" href="#!">Item #2</a>
								</li>

								<li class="header__menu-item">
									<a class="header__menu-link" href="#!">Item #3</a>
								</li>
							</ul>
						</nav>
					</div>

					<div class="header__user-col">
						@auth
						{{ auth()->user()->name }}
						@endauth

						<div class="header__user-menu">
							<ul class="menu list-reset">
								<li class="menu__item">
									<button class="menu__btn">
										<img src="{{ asset('img/header/user.svg') }}" class="header__user-img" alt="Пользователь" />
									</button>

									<div class="dropdown">
										<ul class="dropdown__list">
											@guest
											<li class="dropdown__item">
												<input class="dropdown__btn _modal-open" type="button" value="Войти"
													data-modal-open="modal-login">
											</li>
											@endguest

											@guest
											<li class="dropdown__item">
												<input class="dropdown__btn _modal-open" type="button" value="Регистрация"
													data-modal-open="modal-register">
											</li>
											@endguest

											@can('admin')
											<li class="dropdown__item">
												<a href="{{ route('admin.home') }}" class="dropdown__link" target="_blank">Админка</a>
											</li>
											@endcan

											@auth
											<li class="dropdown__item">
												<form action="{{ route('logout') }}" method="post">
													@csrf
													<input class="dropdown__btn" type="submit" value="Выйти">
												</form>
											</li>
											@endauth
										</ul>
									</div>
								</li>
							</ul>
						</div>

					</div>

				</div>
			</div>
		</header>

		{{-- CONTENT --}}
		@yield('content')
	</div>

	{{-- MODALS --}}
	<div
		class="_modal {{ session()->has('login_error') && $errors->all() != [] || session()->has('login_form') ? ' _active' : '' }}"
		data-modal="modal-login">
		<div class="modal-bg">
			<div class="modal-body modal-body__reg">
				<div class="modal-close">
					<img src="{{ asset('img/header/modal_close.svg') }}" alt="Закрыть" />
				</div>
				<div class="modal__content">
					<div class="modal__title">
						<h3>Вход</h3>
					</div>
					<div class="modal__content-boby">

						@if (session()->has('login_error'))
						<x-register-errors />
						@endif

						<form action="{{ route('login') }}" method="post" id="user-login-form">
							@csrf

							<input type="hidden" name="timezone" id="login-timezone-input" />

							<div class="modal__inputs-wrapper">
								<input type="email" name="email" value="{{ session()->has('login_error') ? old('email') : '' }}"
									placeholder="Адрес электронной почты" class="modal__input" data-modal-input />

								<input type="password" name="password" placeholder="Пароль" class="modal__input" data-modal-input />
							</div>

							<div class="modal__submit">
								<button type="submit" class="modal__login-btn">
									Войти
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div
		class="_modal {{ session()->has('register_error') && $errors->all() != [] || session()->has('register_form') ? ' _active' : '' }}"
		data-modal="modal-register">
		<div class="modal-bg">
			<div class="modal-body modal-body__reg">
				<div class="modal-close">
					<img src="{{ asset('img/header/modal_close.svg') }}" alt="Закрыть" />
				</div>
				<div class="modal__content">
					<div class="modal__title">
						<h3>Регистрация</h3>
					</div>
					<div class="modal__content-boby">

						@if (session()->has('register_error'))
						<x-register-errors />
						@endif

						<form action="{{ route('register') }}" method="post" id="user-register-form">
							@csrf

							<input type="hidden" name="timezone" id="register-timezone-input" />

							<div class="modal__inputs-wrapper">
								<input type="text" name="name" value="{{ old('name') }}" placeholder="Имя" class="modal__input"
									data-modal-input />

								<input type="email" name="email" value="{{ session()->has('register_error') ? old('email') : '' }}"
									placeholder="Адрес электронной почты" class="modal__input" data-modal-input />

								<input type="password" name="password" placeholder="Пароль" class="modal__input" data-modal-input />

								<input type="password" name="password_confirmation" placeholder="Повторите пароль" class="modal__input"
									data-modal-input />
							</div>

							<div class="modal__submit">
								<div class="modal__submit-info">* Заполните все поля</div>

								<button type="submit" class="modal__register-btn">
									Зарегистрироваться
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="_modal {{ session()->has('register_info') ? ' _active' : '' }}" data-modal="modal-register-info">
		<div class="modal-bg">
			<div class="modal-body modal-body__reg">
				<div class="modal-close">
					<img src="{{ asset('img/header/modal_close.svg') }}" alt="Закрыть" />
				</div>
				<div class="modal__content">
					<div class="modal__title">
						<h3>Регистрация</h3>
					</div>
					<div class="modal__content-boby">
						<div class="_register-info">
							{!! session('register_info') !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@yield('modals')

	@yield('scripts')
</body>

</html>