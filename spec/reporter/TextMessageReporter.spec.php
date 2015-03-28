<?php

use Assert\Assertion;
use expect\FailedMessage;
use expect\reporter\TextMessageReporter;

describe('TextMessageReporter', function () {
    beforeEach(function () {
        $this->reporter = new TextMessageReporter();
    });
    describe('#reportFailed', function () {
        it('report failed', function () {
            $message = new FailedMessage();
            $message->appendText('failed');

            ob_start();
            $this->reporter->reportFailed($message);
            $output = ob_get_clean();

            Assertion::same($output, "failed\n");
        });
    });
    describe('#reportNegativeFailed', function () {
        it('report negative failed', function () {
            $message = new FailedMessage();
            $message->appendText('negative failed');

            ob_start();
            $this->reporter->reportNegativeFailed($message);
            $output = ob_get_clean();

            Assertion::same($output, "negative failed\n");
        });
    });
});
