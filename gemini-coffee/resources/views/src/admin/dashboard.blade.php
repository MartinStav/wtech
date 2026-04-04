@extends('layouts.app')
@section('title', 'Admin – Product management')
@section('content')
<main class="container py-5">
        <section class="border border-secondary p-4 mb-4">
            <h1 class="h3 fw-bold text-uppercase mb-1">Admin dashboard</h1>
            <p class="text-secondary mb-0">Product management</p>
        </section>

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <p class="mb-0"><span class="text-secondary">Total products:</span> <strong>8</strong></p>
            <a href="{{ url('/src/admin/product-add.php') }}" class="btn btn-dark rounded-0">+ Add product</a>
        </div>

        <div class="table-responsive border border-secondary">
            <table class="table table-bordered table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Roast</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td class="fw-bold">Brazilian Santos</td>
                        <td>Single Origin</td>
                        <td>15,99 €</td>
                        <td>Brazil</td>
                        <td>Medium</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="fw-bold">Colombian Supremo</td>
                        <td>Single Origin</td>
                        <td>16,99 €</td>
                        <td>Colombia</td>
                        <td>Medium</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="fw-bold">Costa Rican Tarrazu</td>
                        <td>Single Origin</td>
                        <td>18,99 €</td>
                        <td>Costa Rica</td>
                        <td>Medium</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="fw-bold">Decaf Colombia</td>
                        <td>Decaf</td>
                        <td>17,99 €</td>
                        <td>Colombia</td>
                        <td>Medium</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="fw-bold">Espresso Blend</td>
                        <td>Blend</td>
                        <td>19,99 €</td>
                        <td>Multiple</td>
                        <td>Dark</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="fw-bold">Ethiopian Yirgacheffe</td>
                        <td>Single Origin</td>
                        <td>18,99 €</td>
                        <td>Ethiopia</td>
                        <td>Light</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td class="fw-bold">Guatemala Antigua Reserve</td>
                        <td>Single Origin</td>
                        <td>18,99 €</td>
                        <td>Guatemala</td>
                        <td>Medium</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td class="fw-bold">Sumatra Mandheling</td>
                        <td>Single Origin</td>
                        <td>19,99 €</td>
                        <td>Indonesia</td>
                        <td>Medium</td>
                        <td class="text-nowrap">
                            <a href="{{ url('/src/admin/product-edit.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <button type="button" class="btn btn-dark btn-sm rounded-0">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
