<?php

namespace Shizuco\NovaInlineSelectField\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use Shizuco\NovaInlineSelectField\InlineSelect;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaInlineSelectFieldController extends Controller
{
    public function update(NovaRequest $request)
    {
        $modelId = $request->_inlineResourceId;
        $attribute = $request->_inlineAttribute;

        $resourceClass = $request->resource();
        $resourceValidationRules = $resourceClass::rulesForUpdate($request);
        $fieldValidationRules = $resourceValidationRules[$attribute] ?? null;

        if (!empty($fieldValidationRules)) {
            $request->validate([$attribute => $fieldValidationRules]);
        }

        // Find field in question
        try {
            $model = $request->model()->find($modelId);
            $resource = new $resourceClass($model);

            $allFields = collect($resource->fields($request));
            $field = $allFields->first(function ($field) use ($attribute) {
                return get_class($field) === InlineSelect::class && $field->attribute === $attribute;
            });

            $field->fillInto($request, $model, $attribute);
            $model->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response('', 204);
    }
}
