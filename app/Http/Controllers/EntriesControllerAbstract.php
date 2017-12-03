<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Validator;

abstract class EntriesControllerAbstract extends Controller
{


    public function index()
    {
        return view($this->getTemplatesFolder() . '.index');
    }


    public function doCreate(Entry $entry)
    {
        $this->setDefaults($entry);
        return view($this->getTemplatesFolder() . '.create', [
            'method' => 'POST',
            'route' => [static::getRoutePrefix() . '.store'],
            'entry' => $entry,
        ]);
    }


    public function doStore(Request $request, Entry $entry)
    {
        $this->autoGenerateUrl($request);

        static::getValidator($request->all())->validate();

        foreach (static::getFillableFields() as $field) {
            $entry->$field = $request->input($field);
        }

        $entry->save();

        return redirect()->route($this->getRoutePrefix() . '.show', [$this->getRoutePrefix() => $entry->url]);

    }


    public function update(Request $request, Entry $entry)
    {
        $this->validate($request, static::getChecks(true));

        // $entry = $this->getTargetClass()::where('url', $url)->first();

        foreach (static::getFillableFields() as $field) {
            $entry->$field = $request->input($field);
        }

        if ($entry->save()) {
            flash('Материал успешно изменён')->success();
        } else {
            flash('При сохраненеии произошла ошибка.')->success();
        }

        return redirect()->route($this->getRoutePrefix() . '.show', [$this->getRoutePrefix() => $entry->url]);

    }


    public function doShow(Entry $entry)
    {
        ++$entry->views_count;

        $entry->save();

        $data = compact('entry');

        $personal = $this->getTemplatesFolder() . '.' . $entry->url;

        return view(View::exists($personal) ? $personal: $this->getTemplatesFolder() . '.show', $data);
    }


    public function doEdit(Entry $entry)
    {
        return view($this->getTemplatesFolder() . '.edit', [
            'entry' => $entry,
            'method' => 'PATCH',
            'route' => [static::getRoutePrefix() . '.update', $entry->url]
        ]);
    }


    public function doDelete(Entry $entry)
    {
        if ($entry->delete()) {
            flash('Материал удалён', '');
            return redirect()->route(static::getRoutePrefix() . '.index');

        }

        flash('Ошибка при удалении материала', '')->error();
        return redirect()->back();
    }


    protected function autoGenerateUrl(Request $request): void
    {
        if ($request->has('url')) {
            return;
        }

        $url = transliterator_transliterate('Latin-ASCII',
            transliterator_transliterate('Latin', $request->title ?? ''));

        $request->merge([
            'url' => trim(preg_replace(["/[^0-9a-z_\']+/", "/\'/"], ['-', ''], strtolower($url)), '-')
        ]);
    }


    final protected static function getFillableFields(): array
    {
        $model = static::getTargetClass();
        return (new $model)->getFillable();
    }


    final protected static function getValidator(array $data, $update_mode = false): Validator
    {
        return ValidatorFacade::make($data, static::getChecks($update_mode));
    }


    protected static function getChecks(bool $update_mode): array
    {
        return [
            'title' => 'required|max:255' . ($update_mode ? '' : '|unique:' . static::getTableName()),
            'url' => 'required||max:255|regex:/[^0 - 9a - z_]/' . ($update_mode ? '' : '|unique:' . static::getTableName()),
            'content' => 'required|max:65535',
            'meta_tags' => 'max:255',
            'meta_description' => 'max:255',
            'is_active' => 'nullable|max:2',
        ];
    }


    final protected static function getTableName(): string
    {
        $model = static::getTargetClass();
        return (new $model)->getTable();
    }


    protected function setDefaults(Entry $entry)
    {
        $entry->is_active = true;
    }


    abstract protected static function getTemplatesFolder(): string;


    abstract protected static function getRoutePrefix(): string;


    abstract protected static function getTargetClass(): string;

}
