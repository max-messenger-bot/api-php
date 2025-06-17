<?php

declare(strict_types=1);

namespace MaxMessenger\Api\Models\Request\Messages;

use MaxMessenger\Api\Models\Enums\TextFormat;
use MaxMessenger\Api\Models\Request\Model;

use function is_array;

final readonly class NewMessage extends Model
{
    /**
     * @param AttachmentRequest|AttachmentRequest[]|null $attachments
     */
    public function __construct(
        private ?int $userId,
        private ?int $chatId,
        private ?string $text,
        private AttachmentRequest|array|null $attachments,
        private ?NewMessageLink $link,
        private ?bool $notify,
        private TextFormat|string|null $format,
        private ?bool $disableLinkPreview
    ) {
    }

    public function getQuery(): ?array
    {
        $disableLinkPreview = $this->disableLinkPreview;
        if ($disableLinkPreview !== null) {
            $disableLinkPreview = $disableLinkPreview ? 'true' : 'false';
        }

        return array_filter([
            'user_id' => $this->userId,
            'chat_id' => $this->chatId,
            'disable_link_preview' => $disableLinkPreview,
        ], static fn(mixed $value): bool => $value !== null);
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'text' => $this->text,
            'attachments' => $this->attachments === null || is_array($this->attachments)
                ? $this->attachments
                : [$this->attachments],
            'link' => $this->link,
            'notify' => $this->notify,
            'format' => $this->format,
        ], static fn(mixed $value): bool => $value !== null);
    }
}
