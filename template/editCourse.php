<?php require "template/header.phtml"; ?>
<?php if (!empty($course)): ?>
    <?php $course = $course[0]; ?>
    <?php if (is_object($course)): ?>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">

                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 color-p">Editar Curso
                </h2>
            </div>
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="update-course/<?= $course->course_id ?>" method="POST">
                    <div class="form-group">
                        <label class="block text-sm font-medium leading-6 text-gray-900 color-p" for="title">Título:</label>
                        <input
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            type="text" class="form-control" id="title" name="title" maxlength="100"
                            value="<?= $course->title ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-medium leading-6 text-gray-900 color-p" for="category">Categoría:</label>
                        <select class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"id="category" name="category" required>
                            <?php foreach ($categories as $category): ?> 
                                <option value="<?= htmlspecialchars($category->category_id, ENT_QUOTES, 'UTF-8') ?>"
                                <?php if ($category->category_id == $course->category): ?>
                                    selected
                                <?php endif; ?>>
                                <?= htmlspecialchars($category->category_name, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-medium leading-6 text-gray-900 color-p"
                            for="description">Descripción:</label>
                       <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($course->description) ?></textarea>

                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-medium leading-6 text-gray-900 color-p" for="teacher">Profesor:</label>
                        <select
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            id="teacher_id" name="teacher_id" required>
                            <?php foreach ($teachers as $teacher): ?>
                                <option value="<?= $course->teacher_id ?>">
                                    <?= $teacher->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-medium leading-6 text-gray-900 color-p" for="link">Enlace:</label>
                        <input
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            type="text" class="form-control" id="link" name="link" value="<?= $course->link ?>">
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-medium leading-6 text-gray-900 color-p" for="minutes">Duracion en
                            minutos:</label>
                        <input
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            type="text" class="form-control" id="minutes" name="minutes" value="<?= $course->minutes ?>">
                    </div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 custom-button button-add">Crear
                        Curso</button>
                </form>

            </div>
        </div>
    <?php else: ?>
        <p>Error: Curso no encontrado.</p>
    <?php endif; ?>
<?php else: ?>
    <p>Curso no encontrado.</p>
<?php endif; ?>

<?php require "template/footer.phtml"; ?>